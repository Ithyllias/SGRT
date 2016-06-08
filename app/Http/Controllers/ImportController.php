<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Excel;

use App\Http\Requests;

class ImportController extends Controller
{
    /**
     *
     */
    public function ImportForm(){
        return view('import');
    }

    /**
     * Creates new task from excel file
     *
     * @param Request $request
     *
     * @return Response
     */
    public function NewTask(Request $request)
    {
        $errors = array();

        try{
            $taskYear = null;
            $sessId = -1;
            $taskId = -1;

            $sheet = Excel::load($request->file('datafile'))->get()->first();

            foreach($sheet as $row){

                $session = substr($row['session'], 0, 1);

                if($taskYear == null){
                    $taskYear = substr($row['session'], 1);
                    $formattedYear = null;

                    if(strcmp($session, "A") == 0){
                        $formattedYear = $taskYear."-".($taskYear + 1);
                    } else {
                        $formattedYear = ($taskYear - 1)."-".$taskYear;
                    }

                    $taskId = App\Tache::getTacheIdForYear($formattedYear);
                }

                $sessId = App\Session::getSessionIdFromAlias($session);

                if($taskId == -1){
                    array_push($errors, trans('error.taskCreation', ['name'=> $row['session']]));
                } elseif($sessId == -1){
                    array_push($errors, trans('error.session', ['name'=> $row['session']]));
                } elseif(preg_match("/^[a-zA-Z0-9]{3}-[a-zA-Z0-9]{3}-[a-zA-Z0-9]{2}$/",$row['cours']) != 1){
                    array_push($errors, trans('error.courseCode', ['name'=> $row['cours']]));
                }

                if(count($errors) > 0){
                    continue;
                }

                if(!App\CoursDonne::addSingle($row['prevision'], $taskId, $row['cours'], $sessId)){
                    array_push($errors, trans('error.newTaskInsert'));
                }
            };
        } catch(Exception $e){
            return redirect()->back()->with('error', 'error.upload');
        }

        if(count($errors) > 0){
            return redirect()->back()->with('error', trans('error.importError').implode("\n",$errors));
        }

        return redirect()->back()->with('success', trans('gestion.importSuccess'));
    }

    /**
     * Creates real task entries from excel file
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function RealTask(Request $request)
    {
        $errors = array();

        try{
            $taskYear = null;
            $taskId = -1;

            $sheet = Excel::load($request->file('datafile'))->get()->first();

            foreach($sheet as $row) {

                $errors = array();
                $teachers = array();
                $session = substr($row['session'], 0, 1);
                $sessId = -1;

                if ($taskYear == null) {
                    $taskYear = substr($row['session'], 1);
                    $formattedYear = null;

                    if(strcmp($session, "A") == 0){
                        $formattedYear = $taskYear."-".($taskYear + 1);
                    } else {
                        $formattedYear = ($taskYear - 1)."-".$taskYear;
                    }

                    $taskId = App\Tache::getTacheIdForYear($formattedYear);
                }

                $sessId = App\Session::getSessionIdFromAlias($session);
                
                if ($taskId == -1) {
                    array_push($errors, trans('error.taskCreation', ['name' => $row['session']]));
                } elseif ($sessId == -1) {
                    array_push($errors, trans('error.session', ['name' => $row['session']]));
                } elseif (preg_match("/^[a-zA-Z0-9]{3}-[a-zA-Z0-9]{3}-[a-zA-Z0-9]{2}$/", $row['cours']) != 1) {
                    array_push($errors, trans('error.courseCode', ['name' => $row['cours']]));
                }

                foreach (explode(';', $row['prof']) as $prof){
                    $profId = App\Enseignant::getIdFromAlias($prof);
                    if($profId != -1){
                        $teachers[$profId] = $prof;
                    } else {
                        array_push($errors, trans('error.noTeacher', ['name'=> $prof]));
                    }
                }
                
                if (count($errors) > 0) {
                    continue;
                }

                App\Tache::closeTache($taskId);
                $cdnId = App\CoursDonne::getCDNId($taskId, $sessId, $row['cours']);

                if($cdnId == -1){
                    array_push($errors, trans('error.noTask', ['sess'=> $row['session'], 'cours'=> $row['cours']]));
                }

                if(count($errors) > 0){
                    continue;
                }

                foreach($teachers as $id => $prof){
                    if(!App\TacheReelle::addSingle($cdnId,$id)){
                        array_push($errors, trans('error.realTaskInsert', ['sess'=> $row['session'], 'cours'=> $row['cours'], 'prof' => $prof]));
                    }
                }

            };
        } catch(Exception $e){
            return redirect()->back()->with('error', 'error.upload');
        }

        if(count($errors) > 0){
            return redirect()->toto();//back()->with('error', trans('error.importError').implode("\n",$errors));
        }

        return redirect()->back()->with('success', trans('gestion.importSuccess'));
    }

    /**
     * Inserts initial marble amounts from excel file
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function StartMarbles(Request $request)
    {
        $errors = array();

        try{
            $sheet = Excel::load($request->file('datafile'))->get()->first();

            foreach($sheet as $row) {
                $prof = $row['prof'];
                $coursNo = $row['cours'];
                $profId = App\Enseignant::getIdFromAlias($prof);

                if($profId == -1){
                    array_push($errors, trans('error.noTeacher', ['name'=> $prof]));
                } elseif (preg_match("/^[a-zA-Z0-9]{3}-[a-zA-Z0-9]{3}-[a-zA-Z0-9]{2}$/", $coursNo) != 1) {
                    array_push($errors, trans('error.courseCode', ['name' => $coursNo]));
                }

                if(count($errors) > 0){
                    continue;
                }

                if(!App\BillesDepart::addSingle($profId, $coursNo, $row['billes'])){
                    array_push($errors, trans('error.marbleInsert', ['cours'=> $row['cours'], 'prof' => $prof]));
                };

            };
        } catch(Exception $e){
            return redirect()->back()->with('error', 'error.upload');
        }

        if(count($errors) > 0){
            return redirect()->back()->with('error', trans('error.importError').implode("\n",$errors));
        }

        return redirect()->back()->with('success', trans('gestion.importSuccess'));
    }
}
