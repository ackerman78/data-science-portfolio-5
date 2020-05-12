<?php
require('../library/fpdf.php');
$result=$_POST['result'];
$name=$_POST['name3'];
$age=$_POST['age3'];
$sex=$_POST['sex3'];
$cp=$_POST['cp3'];
$trestbps=$_POST['trestbps3'];
$chol=$_POST['chol3'];
$fbps=$_POST['fbps3'];
$restecg=$_POST['restecg3'];
$thalach=$_POST['thalach3'];
$exang=$_POST['exang3'];
$oldpeak=$_POST['oldpeak3'];
$slope=$_POST['slope3'];
$ca=$_POST['ca3'];
$thal=$_POST['thal3'];

if($sex==0)
{
    $sex='Female';
}
else
{
    $sex='Male';
}

if($cp==1)
{
    $cp='typical angina';
    $cpcomment='abnormal';
}
elseif($cp==2)
{
    $cp='atypical angina';
    $cpcomment='abnormal';
}
elseif($cp==3)
{
    $cp='non-anginal pain';
    $cpcomment='abnormal';
}
else
{
    $cp='asymptomatic';
    $cpcomment='abnormal';
}
//Sugar Comment
if($trestbps<120 and $trestbps>80)
{
    $trestbpscomment='normal';
}
elseif($trestbps<80)
{   
    $trestbpscomment='below normal';
}
else
{
    $trestbpscomment='above normal';
}
//Cholestrol Comment
if($chol<239 and $chol>200)
{
    $cholcomment='normal';
}
elseif($chol<200)
{   
    $cholcomment='below normal';
}
else
{
    $cholcomment='above normal';
}
//Fasting Blood Sugar

if($fbps==1)
{
    $fbps='>120';
    $fbscomment='abnormal';
}
else
{
    $fbps='<120';
    $fbscomment='normal';
}

if($restecg==0)
{
    $restecg='normal';
    $restecgcomment='normal';
}
elseif($restecg==1)
{
    $restecg='having ST-T wave abnormality';
    $restecgcomment='abnormal';
}
else
{
    $restecg='Left Ventricular';
    $restecgcomment='abnormal';
}

if($exang==1)
{
    $exang='yes';

}
else
{
    $exang='no';
}

if($slope==1)
{
    $slope='upsloping';
}
elseif($slope==2)
{
    $slope='flat';
}
else
{
    $slope='downsloping';
}
if($ca==0)
{
    $cacomment='normal';
}
else
{
    $cacomment='abnormal';
}

if($thal==3)
{
    $thal='normal';
    $thalcomment='normal';
}
elseif($thal==6)
{
    $thal='fixed defect';
    $thalcomment='defected';
}
else
{
    $thal='reverseable defect';
    $thalcomment='defected';
}

class PDF extends FPDF
{
// Page header
function Header()
{
    
    // Logo
    $this->Image('Logo.png',15,3,20);
    // Arial bold 15
    $this->SetFont('Times','',22);
    // Move to the right
    //Main Title
    $this -> SetY(11);
    $this->Cell(80);
    $this->Cell(5,5,'Cardisys',0,0,'L');
    $this -> SetY(20);
    $this->Cell(55);
    // Title
    
    $this->Cell(10,10,'Department Of Cardiology',0,0,'L');
    
    // Line break
    $this->Line(5,30,205,30);
    $this -> SetY(30);
    $this->Cell(72);
    $this->SetFont('Times','',14);
    $this->Cell(10,10,'Personal Information',0,0,'L');

    $this->ln(10);
    
}
function headerTable()
{
    global $name;
    global $sex;
    global $age;
    global $cp;
    global $cpcomment;
    global $trestbps;
    global $trestbpscomment;
    global $chol;
    global $cholcomment;
    global $fbps;
    global $fbscomment;
    global $restecg;
    global $restecgcomment;
    global $thalach;
    global $exang;
    global $oldpeak;
    global $slope;
    global $ca;
    global $cacomment;
    global $thal;
    global $thalcomment;
    global $result;
    
    $thalachsafe=220-$age;

    if($thalach<$thalachsafe)
    {
        $thalachcomment='normal';
    }
    elseif($thalach>$thalachsafe)
    {
        $thalachcomment='above normal';
    }
    elseif($thalach<60)
    {
        $thalachcomment='below normal';
    }

    $this->Line(5,55,205,55);
    $this->SetFont('Times','',12);
    //Row Patiet's Data
    $this->Cell(34,6,'   Patient Name: ',0,0,'R');
    $this->SetFont('Times','B',12);
    $this->Cell(65,6,$name,0,0,'L');
    $this->SetFont('Times','',12);
    $this->Cell(40,6,'   Date:',0,0,'R');
    $this->SetFont('Times','B',12);
    $this->Cell(45,6,date("d-m-Y"),0,1,'L');
    $this->SetFont('Times','',12);
    $this->Cell(34,10,'   Sex:',0,0,'R');
    $this->SetFont('Times','B',12);
    $this->Cell(65,10,$sex,0,0,'L');
    $this->SetFont('Times','',12);
    $this->Cell(40,10,'   Age:',0,0,'R');
    $this->SetFont('Times','B',12);
    $this->Cell(65,10,$age,0,0,'L');
    $this->ln(11);

    //Row Label
    $this->setFillColor(211,211,211);
    $this->Line(5,64,205,64);
    $this->SetFont('Times','B',12);

    $this->Cell(-5);

    $this->Cell(45,6,'Test',0,0,'L');
    $this->Cell(71,6,'Values',0,0,'C');
    $this->Cell(20,6,'Unit',0,0,'C');
    $this->Cell(37,6,'Reference Value',0,0,'L');
    $this->Cell(27,6,'Comments  ',0,1,'R');

    //Row1
    $this->SetFont('Times','',12);
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(45,6,'Age',0,0,'L','True');
    $this->Cell(71,6,$age,0,0,'C','True');
    $this->Cell(20,6,'years',0,0,'C','True');
    $this->Cell(37,6,'<120',0,0,'C','True');
    $this->Cell(27,6,'-',0,1,'C','True');

    //Row2
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(45,6,'Sex',0,0,'L');
    $this->Cell(71,6,$sex,0,0,'C');
    $this->Cell(20,6,'-',0,0,'C');
    $this->Cell(37,6,'-',0,0,'C');
    $this->Cell(27,6,'-',0,1,'C');

    //Row3
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(45,6,'Chest Pain',0,0,'L','True');
    $this->Cell(71,6,$cp,0,0,'C','True');
    $this->Cell(20,6,'type',0,0,'C','True');
    $this->Cell(37,6,'-',0,0,'C','True');
    $this->Cell(27,6,$cpcomment,0,1,'C','True');
    //Row4
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(45,6,'Resting Blood Pressure',0,0,'L');
    $this->Cell(71,6,$trestbps,0,0,'C');
    $this->Cell(20,6,'mm Hg',0,0,'C');
    $this->Cell(37,6,'80-120',0,0,'C');
    $this->Cell(27,6,$trestbpscomment,0,1,'C');

    //Row5
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(45,6,'Serum Cholestrol',0,0,'L','True');
    $this->Cell(71,6,$chol,0,0,'C','True');
    $this->Cell(20,6,'mg/dl',0,0,'C','True');
    $this->Cell(37,6,'200-239',0,0,'C','True');
    $this->Cell(27,6,$cholcomment,0,1,'C','True');

    //Row6
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(45,6,'Fasting Blood Sugar',0,0,'L');
    $this->Cell(71,6,$fbps,0,0,'C');
    $this->Cell(20,6,'mg/dl',0,0,'C');
    $this->Cell(37,6,'<120',0,0,'C');
    $this->Cell(27,6,$fbscomment,0,1,'C');

    //Row7
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(45,6,'Resting Electrodiagraphic',0,0,'L','True');
    $this->Cell(71,6,$restecg,0,0,'C','True');
    $this->Cell(20,6,'type',0,0,'C','True');
    $this->Cell(37,6,'normal',0,0,'C','True');
    $this->Cell(27,6,$restecgcomment,0,1,'C','True');

    //Row8
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(45,6,'Thalach',0,0,'L');
    $this->Cell(71,6,$thalach,0,0,'C');
    $this->Cell(20,6,'bpm',0,0,'C');
    $this->Cell(37,6, $thalachsafe,0,0,'C');
    $this->Cell(27,6,$thalachcomment,0,1,'C');

    //Row9
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(45,6,'Exercise Induced Angina',0,0,'L','True');
    $this->Cell(71,6,$exang,0,0,'C','True');
    $this->Cell(20,6,'   type',0,0,'C','True');
    $this->Cell(37,6,'   normal',0,0,'C','True');
    $this->Cell(27,6,$exang,0,1,'C','True');

    //Row10
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(45,6,'Old Peak',0,0,'L');
    $this->Cell(71,6,$oldpeak,0,0,'C');
    $this->Cell(20,6,'mm',0,0,'C');
    $this->Cell(37,6,'-',0,0,'C');
    $this->Cell(27,6,'-   ',0,1,'C');

    //Row11
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(45,6,'Slope ',0,0,'L','True');
    $this->Cell(71,6,$slope,0,0,'C','True');
    $this->Cell(20,6,'ms',0,0,'C','True');
    $this->Cell(37,6,'-',0,0,'C','True');
    $this->Cell(27,6,$slope,0,1,'C','True');

    //Row12
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(45,6,'Ca',0,0,'L');
    $this->Cell(71,6,$ca,0,0,'C');
    $this->Cell(20,6,'vessels',0,0,'C');
    $this->Cell(37,6,'0',0,0,'C');
    $this->Cell(27,6,$cacomment,0,1,'C');

    //Row13
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(45,6,'Thal',0,0,'L','True');
    $this->Cell(71,6,$thal,0,0,'C','True');
    $this->Cell(20,6,'type',0,0,'C','True');
    $this->Cell(37,6,'normal',0,0,'C','True');
    $this->Cell(27,6,$thalcomment,0,1,'C','True');

    $this->ln(10);
    $this->Cell(-5);
    $this->SetFont('Times','B',15);
    
    $this->Cell(50,7,'Analysis ',0,0,'');
    
    $this->ln(10);
    $this->Line(5,169,205,169);

    $this->SetFont('Times','',12);
    $this->Cell(-5);
    $this->MultiCell(190,7,'Your Chest Pain status is '.$cpcomment.', resting blood pressure is '.$trestbpscomment.', hdl cholestrol level is '.$cholcomment.', fasting blood sugar is '.$fbscomment.', status of resting ECG is '.$restecgcomment.', heart beat rate is '.$thalachcomment.', exercise induced angina status is '.$exang.', no of major vesseles coloured by floroscopy are '.$ca.' and thal is '.$thalcomment,0,'J',0);
    $this->ln(3);
    $this->Cell(-5);
    $this->SetFont('Times','B',15);
    $this->Cell(50,7,'Result ',0,0,'');

    if($result=='0')
    {
        $resultcomment='Above analysis shows that patient have low risk of cardiac disease.';
    }
    else
    {
        $resultcomment='Above analysis shows that patient have high risk of cardiac disease.';
    }
    $this->ln(10);
    $this->Cell(-5);
    $this->SetFont('Times','',12);
    $this->Cell(50,7,$resultcomment,0,0,'');

    $this->SetY(275);
    $this->Cell(152);
    $this->SetFont('Times','',10);
    $this->Cell(10,1,'Generated by Cardisys '.chr(169),0,0,'');
    
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->Line(5,285,205,285);
    $this->SetY(-12);
    // Arial italic 8
    $this->SetFont('Times','B',10);
    // Page number
    $this->Cell(0,10,'NOTE: This is an electronically verified report and does not require a signature unless edited by hand. ',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->header();
$pdf->headerTable();
$pdf->Image('qrcardisys.png',172,250,20);
$pdf->Output();
?>