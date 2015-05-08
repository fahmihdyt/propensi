<?php

namespace app\controllers;

use Yii;
use app\models\Project;
use app\models\Aktivitas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Site;
use app\models\Klien;
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\PhpWord;




/**
 * BarismilestoneController implements the CRUD actions for Barismilestone model.
 */
class ReportController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['get'],
                ],
            ],
        ];
    }

    /**
     * Lists all Barismilestone models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$model=new Project();
		$models=$model->find()->all();
		
		return $this->render('index',['project'=>$models]);
    }
	
	public function actionFilter(){
		$id=$_GET['id'];
		
		$projectList=Project::find()->all();
		$site=Site::findAll(['proyek'=>$id]);
		$project=Project::findOne(['id'=>$id]);
		$klien=Klien::findOne(['id'=>$project->klienId]);
		
		return $this->render('filter',[
			'projectList'=>$projectList,
			'site'=>$site,
			'project'=>$project,
			'klien'=>$klien
		]);
		
	}
	
	public function actionExport($id){
		
			
		$site=Site::findAll(['proyek'=>$id]);
		$project=Project::findOne(['id'=>$id]);
		$klien=Klien::findOne(['id'=>$project->klienId]);
		
		//Initialize Word Object
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$section = $phpWord->addSection();
		
		//set default setting
		$phpWord->setDefaultFontName('Arial');
		$phpWord->setDefaultFontSize(12);
		
		/*-------------------HEADER-------------------------*/
		$fontStyle = array('size'=>18, 'bold'=>true);
		$phpWord->addFontStyle('myOwnStyle', $fontStyle);
		
		$paragraphStyle=array('align'=>'center');		
		$phpWord->addParagraphStyle('title', $paragraphStyle);
		$text = $section->addText('Report', 'myOwnStyle','title');
		$text = $section->addText('Project '.$project['nama'], 'myOwnStyle','title');
		
		/*----------------Client Detail--------------------*/
		$paragraphStyle=array('spaceAfter'=>0);		
		$phpWord->addParagraphStyle('clientPar', $paragraphStyle);
		
		$fontStyle = array('size'=>12, 'italic'=>true,'bold'=>true);
		$phpWord->addFontStyle('client', $fontStyle);
		$text= $section->addText('Client Detail','client');
		
		$tableKlien=$section->addTable();
		$tableKlien->addRow(200);		
		$tableKlien->addCell(2000)->addText('Client Name  ');
		$tableKlien->addCell(4000)->addText(': '.$klien['nama']);
		$tableKlien->addRow(200);
		$tableKlien->addCell(2000)->addText('Telephone  ');
		$tableKlien->addCell(4000)->addText(': '.$klien['no_telp']);
		$tableKlien->addRow(200);
		$tableKlien->addCell(2000)->addText('Email  ');
		$tableKlien->addCell(4000)->addText(': '.$klien['email']);
		$tableKlien->addRow(200);
		$tableKlien->addCell(2000)->addText('Address  ');
		$tableKlien->addCell(4000)->addText(': '.$klien['alamat']);
		
		$section->addTextBreak(1);
		
		/*----------------Site Detail--------------------*/
		//cetak 'site detail'
		$fontStyle = array('size'=>12, 'italic'=>true,'bold'=>true);
		$phpWord->addFontStyle('site', $fontStyle);
		$text= $section->addText('Site Detail','site');		
		
		
		//cetak list of site
		$fontStyle = array('size'=>11,'bold'=>true);
		$phpWord->addFontStyle('siteTitle', $fontStyle);
		
		//set up table list aktivitas style
		$styleTable = array('borderSize'=>6, 'borderColor'=>'006699', 'cellMargin'=>80);
		$styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF');
		$phpWord->addTableStyle('aktivitasTable',$styleTable,$styleFirstRow);
		
		if(count($site)>0){
			foreach($site as $row){
			//cetak site title
			$text= $section->addText('Site '.$row['nama']." : ".$row['status_kerja'],'siteTitle');
			
			//Inisiasi Aktivitas
			$aktivitas=$row->getActivity($row['id']);
			
			
			$fontStyle = array('size'=>10,'bold'=>true);
			$phpWord->addFontStyle('activityTitle', $fontStyle);
			
			//proses cetak Aktivitas
			if(count($aktivitas)>0){
				//header table
				$tableAktivitas=$section->addTable('aktivitasTable');
				$tableAktivitas->addRow(400);
				$tableAktivitas->addCell(2000)->addText('Date','activityTitle');
				$tableAktivitas->addCell(2000)->addText('Activity','activityTitle');
				$tableAktivitas->addCell(2000)->addText('PIC','activityTitle');
				$tableAktivitas->addCell(2000)->addText('Deadline','activityTitle');
				$tableAktivitas->addCell(2000)->addText('Status','activityTitle');
			
				//isi table
				foreach($aktivitas as $rows){
					$tableAktivitas->addRow(400);
					$tableAktivitas->addCell(2000)->addText($rows['tanggal']);
					$tableAktivitas->addCell(2000)->addText($rows['judul']);
					$tableAktivitas->addCell(2000)->addText($rows->findCreator($rows['creator']));
					$deadline=$rows->getDeadline($rows['type']);
					$tableAktivitas->addCell(2000)->addText($deadline['tanggal']);
					$tableAktivitas->addCell(2000)->addText($rows['status']);
				}
			}
			else{
				$fontStyle = array('size'=>12, 'italic'=>true);
				$phpWord->addFontStyle('noAvailable', $fontStyle);
				$text= $section->addText('No Available Activity','noAvailable');	
			}
			
			}
		}
		else{
			$fontStyle = array('size'=>12, 'italic'=>true);
			$phpWord->addFontStyle('noAvailable', $fontStyle);
			$text= $section->addText('No Available Site','noAvailable');
		}
		

		//Add Footer
		$footer = $section->createFooter();
		$footer->addPreserveText('Page {PAGE} of {NUMPAGES}.', array('align'=>'right'));
		
		
		// Saving the document as OOXML file...
		$temp=str_replace(' ', '', $project['nama']);
		$filename="Laporan".$temp.".docx";
		//return $filename;
		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		ob_clean();
		$objWriter->save($filename);
		
		
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		flush();
		readfile($filename);
		unlink($filename); // deletes the temporary file
		exit;
				
		return $this->render('filter',[
			'projectList'=>$projectList,
			'site'=>$site,
			'project'=>$project,
			'klien'=>$klien
		]);
		
		
	}
	
	

   

   
}
