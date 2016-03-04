<?php


namespace App\Http\Controllers;

use App\Pupil;
use App\Test;
use App\Mistake;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{


    public function setPupil()
    {
        if(!empty($_POST['data'])){
            $data = json_decode($_POST['data']);
            $query = DB::table('pupils')
                ->select('id')
                ->where('name','=',$data[0])
                ->get();

            if(!empty($query)){
                $id = $query[count($query)-1]->id;
                $testId = $this->createTest($id, json_encode($data[1]));
                return array('pupilId' => $id, 'testId' => $testId);
            }
            else{
                return $this->createPupil($data[0], json_encode($data[1]));
            }
        }
    }

    public function createPupil($name, $types)
    {
        if(!empty($name)){
            Pupil::create(
                [
                    'name' => $name,
                ]
            );
            $query = DB::table('pupils')
                ->select('id')
                ->where('name','=',$name)
                ->get();
            $id = $query[count($query)-1]->id;
            $testId = $this->createTest($id, $types);
            return array('pupilId' => $id, 'testId' => $testId);
        }
    }

    public function createTest($pupilId, $types)
    {
        if (isset($pupilId) && isset($types)) {
            Test::create(
                [
                    'pupil_id' => $pupilId,
                    'types' => $types,
                ]
            );

            $query = DB::table('tests')
                ->select('id')
                ->where('pupil_id', '=', $pupilId)
                ->get();
            return $query[count($query) - 1]->id;
        }
    }

    public function createMistake()
    {
        if(!empty($_POST['data'])){
            $data = json_decode($_POST['data']);
            Mistake::create(
                [
                    'test_id' => $data[0],
                    'sample' => $data[1],
                    'answer' => $data[2],
                ]
            );
        }
    }

    public function editTestCorrect()
    {
        if(!empty($_POST['data'])){
            $testId = $_POST['data'];
            DB::table('tests')->where('id','=',$testId)
                ->increment('correct');
            DB::table('tests')->where('id','=',$testId)
                ->decrement('incorrect');
        }
    }

    public function getReport()
    {
        $date = $_POST['data'];
        $date = json_decode($_POST['data']);

        $dateFrom = $date[0] ? strtotime($date[0]) : 0;
        $dateTo = $date[1] ? strtotime($date[1]) : time();

        // all tests results
        $query = DB::table('tests')
            ->join('pupils','pupils.id','=','tests.pupil_id')
            ->select('pupils.name','tests.created_at','tests.types','tests.correct','tests.incorrect', DB::raw('(tests.correct)*100/10 as percents'))
            ->where(DB::raw('UNIX_TIMESTAMP(created_at)'),'>',$dateFrom)
            ->where(DB::raw('UNIX_TIMESTAMP(created_at)'),'<',$dateTo)
            ->orderby('created_at','desc')  //->orderby('pupil_id','asc')
            ->get();

        $report['tests_res'] = $query;

        //absent pupils
        $absent = DB::table('pupils')
            ->join('tests','pupils.id','=','tests.pupil_id')
            ->select('pupils.name', DB::raw('SUM(tests.correct) as total'))
            ->where(DB::raw('UNIX_TIMESTAMP(tests.created_at)'),'>',$dateFrom)
            ->where(DB::raw('UNIX_TIMESTAMP(tests.created_at)'),'<',$dateTo)
            ->groupby('pupil_id')
            ->having('total', '=', 0)
            ->get();

        $report['absent'] = $absent;

        //lagging pupils
        $lagging = DB::table('pupils')
            ->join('tests','pupils.id','=','tests.pupil_id')
            ->select('pupils.name', DB::raw('count(*) as total'))
            ->where(DB::raw('tests.correct/10'),'<',0.51)
            ->where(DB::raw('UNIX_TIMESTAMP(created_at)'),'>', $dateFrom)
            ->where(DB::raw('UNIX_TIMESTAMP(created_at)'),'<', $dateTo)
            ->groupby('pupil_id')
            ->having('total','>',2)
            ->get();

        $report['lagging'] = $lagging;

        return view('report', array('report' => $report));
    }
}