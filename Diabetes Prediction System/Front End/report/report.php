<?php
require('../library/fpdf.php');
$result=$_POST['result'];
$name=$_POST['name3'];
$pregnancies=$_POST['pregnancies3'];
$glucose=$_POST['glucose3'];
$bloodpressure=$_POST['bloodpressure3'];
$skinthickness=$_POST['skinthickness3'];
$insulin=$_POST['insulin3'];
$bmi=$_POST['bmi3'];
$diabetespedigreefunction=$_POST['diabetespedigreefunction3'];
$age=$_POST['age3'];

//Glucose Comment
if($glucose<140 && $glucose>0)
{
    $glucosecomment='normal';
}
elseif($glucose>=140 && $glucose<=199)
{
    $glucosecomment='pre-diabetic';
}
else
{
    $glucosecomment='diabetic';
}
//Blood Pressure Comment
if($bloodpressure<60 && $bloodpressure>0)
{
    $bpcomment='below normal';
}
elseif($bloodpressure<80 && $bloodpressure>=60)
{
    $bpcomment='normal';
}
elseif($bloodpressure>=80 && $bloodpressure<=89)
{
    $bpcomment='stage 1 hypertension';
}
elseif($bloodpressure>=90 && $bloodpressure<=119)
{
    $bpcomment='stage 2 hypertension';
}
else
{
    $bpcomment='hypertensive crisis';
}
//Skin Fold Thickness Comment ---
if($skinthickness<10 && $skinthickness>0)
{
    $skinthicknesscomment='below normal';
}
elseif($skinthickness<=30 && $skinthickness>=10)
{
    $skinthicknesscomment='normal';
}
else
{
    $skinthicknesscomment='above normal';
}
//Insulin Comment
if($insulin<200 and $insulin>0)
{
    $insulincomment='normal';
}
else
{
    $insulincomment='above normal';
}
//BMI Comment
if($bmi<18.5 and $bmi>0)
{
    $bmicomment='underweight';
}
elseif($bmi>=18.5 && $bmi<=25)
{
    $bmicomment='normal';
}
elseif($bmi>25 && $bmi<=30)
{
    $bmicomment='overweight';
}
else
{
    $bmicomment='Obese';
}

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('Logo.png',15,8,15);

    $this->SetFont('Times','',22);

    //Main Title
    $this -> SetY(10);
    $this->Cell(80);
    $this->Cell(30,5,'Diabetes Prediction System',0,0,'C');
    $this -> SetY(18);
    $this->Cell(55);

    // Title
    $this->Cell(80,10,'Department Of Health',0,0,'C');
    
    // Line break
    $this->Line(5,31,205,31);
    $this -> SetY(32);
    $this->Cell(72);
    $this->SetFont('Times','',14);
    $this->Cell(10,10,'Personal Information',0,0,'L');

    $this->ln(10);
}
function headerTable()
{
    global $name;
    global $pregnancies;
    global $glucose;
    global $glucosecomment;
    global $bloodpressure;
    global $bpcomment;
    global $skinthickness;
    global $skinthicknesscomment;
    global $insulin;
    global $insulincomment;
    global $bmi;
    global $bmicomment;
    global $diabetespedigreefunction;
    global $age;
    global $result;

    $this->Line(5,55,205,55);
    $this->SetFont('Times','',12);

    //Row Patiet's Data
    $this -> SetX(15);
    $this->Cell(27,14,'Patient Name: ',0,0,'L');
    $this->SetFont('Times','B',12);
    $this->Cell(51,14,$name,0,0,'L');
    $this->SetFont('Times','',12);
    $this->Cell(14,14,'   Age:',0,0,'L');
    $this->SetFont('Times','B',12);
    $this->Cell(51,14,$age,0,0,'L');
    date_default_timezone_set('Asia/Karachi');
    $this->SetFont('Times','',12);
    $this->Cell(15,14,'   Date:',0,0,'L');
    $this->SetFont('Times','B',12);
    $this->Cell(45,14,date("d-m-Y"),0,1,'L');
    $this->ln(1);

    //Row Label
    $this->setFillColor(211,211,211);
    $this->Line(5,64,205,64);
    $this->SetFont('Times','B',12);

    $this->Cell(-5);

    $this->Cell(48,6,'Test',0,0,'L');
    $this->Cell(68,6,'Values',0,0,'C');
    $this->Cell(20,6,'Unit',0,0,'C');
    $this->Cell(37,6,'Reference Value',0,0,'L');
    $this->Cell(27,6,'Comments  ',0,1,'R');

    //Row1
    $this->SetFont('Times','',12);
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(48,6,'Pregnancies',0,0,'L','True');
    $this->Cell(68,6,$pregnancies,0,0,'C','True');
    $this->Cell(20,6,'-',0,0,'C','True');
    $this->Cell(37,6,'0-17',0,0,'C','True');
    $this->Cell(27,6,'-',0,1,'C','True');

    //Row2
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(48,6,'Glucose',0,0,'L');
    $this->Cell(68,6,$glucose,0,0,'C');
    $this->Cell(20,6,'mg/dl',0,0,'C');
    $this->Cell(37,6,'<140',0,0,'C');
    $this->Cell(27,6,$glucosecomment,0,1,'C');

    //Row3
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(48,6,'Diastolic Blood Pressure',0,0,'L','True');
    $this->Cell(68,6,$bloodpressure,0,0,'C','True');
    $this->Cell(20,6,'mm/HG',0,0,'C','True');
    $this->Cell(37,6,'<80',0,0,'C','True');
    $this->Cell(27,6,$bpcomment,0,1,'C','True');

    //Row4
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(48,6,'Tricep Skin Thickness',0,0,'L');
    $this->Cell(68,6,$skinthickness,0,0,'C');
    $this->Cell(20,6,'mm',0,0,'C');
    $this->Cell(37,6,'10-30',0,0,'C');
    $this->Cell(27,6,$skinthicknesscomment,0,1,'C');

    //Row5
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(48,6,'Insulin',0,0,'L','True');
    $this->Cell(68,6,$insulin,0,0,'C','True');
    $this->Cell(20,6,'mu U/ml',0,0,'C','True');
    $this->Cell(37,6,'1-199',0,0,'C','True');
    $this->Cell(27,6,$insulincomment,0,1,'C','True');

    //Row6
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(48,6,'Body Mass Index',0,0,'L');
    $this->Cell(68,6,$bmi,0,0,'C');
    $this->Cell(20,6,'kg/m',0,0,'C');
    $this->Cell(37,6,'18.5-25',0,0,'C');
    $this->Cell(27,6,$bmicomment,0,1,'C');

    //Row7
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(48,6,'Diabetes Pedigree Function',0,0,'L','True');
    $this->Cell(68,6,$diabetespedigreefunction,0,0,'C','True');
    $this->Cell(20,6,'-',0,0,'C','True');
    $this->Cell(37,6,'-',0,0,'C','True');
    $this->Cell(27,6,'-',0,1,'C','True');

    //Row8
    $this->ln(2);
    $this->Cell(-5);
    $this->Cell(48,6,'Age',0,0,'L');
    $this->Cell(68,6,$age,0,0,'C');
    $this->Cell(20,6,'years',0,0,'C');
    $this->Cell(37,6,'<82',0,0,'C');
    $this->Cell(27,6,'-',0,1,'C');

    $this->ln(10);
    $this->Cell(-5);
    $this->SetFont('Times','B',15);
    
    $this->Cell(50,7,'Analysis ',0,0,'');
    
    $this->ln(10);
    $this->Line(5,129,205,129);

    $this->SetFont('Times','',12);
    $this->Cell(-5);
    $this->MultiCell(190,7,'Your Plasma Glucose concentration status is '.$glucosecomment.', Diastolic Blood Pressure status is '.$bpcomment.', Triceps Skin Fold Thickness status is '.$skinthicknesscomment.', Serum Insulin status is '.$insulincomment.', Body Mass Index status is '.$bmicomment,0,'J',0);
    $this->ln(6);
    $this->Cell(-5);
    $this->SetFont('Times','B',15);
    $this->Cell(50,7,'Result ',0,0,'');

    if($result=='0')
    {
        $resultcomment='Above analysis shows that patient have low risk of diabetes.';
    }
    else
    {
        $resultcomment='Above analysis shows that patient have high risk of diabetes.';
    }
    $this->ln(10);
    $this->Cell(-5);
    $this->SetFont('Times','',12);
    $this->Cell(50,7,$resultcomment,0,0,'');

    $this->SetY(275);
    $this->Cell(156);
    $this->SetFont('Times','',10);
    $this->Cell(10,1,'Generated by DPS '.chr(169),0,0,'');
    
}

// Page footer
function Footer()
{
    $this->Line(5,285,205,285);
    $this->SetY(-12);

    $this->SetFont('Times','B',10);

    $this->Cell(0,10,'NOTE: This is an electronically verified report and does not require a signature unless edited by hand. ',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->header();
$pdf->headerTable();
$pdf->Image('qrdps.png',172,250,20);
$pdf->Output();
?>