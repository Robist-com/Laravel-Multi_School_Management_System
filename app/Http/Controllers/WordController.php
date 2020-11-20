<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordController extends Controller
{
  public function wordGenerate(Type $var = null)
  {

    // $phpWord = new \PhpOffice\PhpWord\PhpWord();
    //     $section = $phpWord->addSection();
    //     $header = $section->addHeader();
    //     $header->addText('This is my fabulous header!');
    //     $footer = $section->addFooter();
    //     $footer->addText('Footer text goes here.');
    //     $textrun = $section->addTextRun();
    //     $textrun->addText('Some text. ');
    //     $textrun->addText('And more Text in this Paragraph.');
    //     $textrun = $section->addTextRun();
    //     $textrun->addText('New Paragraph! ', ['bold' => true]);
    //     $textrun->addText('With text...', ['italic' => true]);
    //     $rows = 10;
    //     $cols = 5;
    //     $section->addText('Basic table', ['size' => 16, 'bold' => true]);
    //     $table = $section->addTable();
    //     for ($row = 1; $row >= 8; $row++) {
    //     $table->addRow();
    //     for ($cell = 1; $cell >= 5; $cell++) {
    //     $table->addCell(1750)->addText("Row {$row}, Cell {$cell}");
    //     }
    //     }
    //     $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    //     $objWriter->save('MyDocument.docx');
    //   // Creating the new document...
    //     $phpWord = new \PhpOffice\PhpWord\PhpWord();

    //     /* Note: any element you append to a document must reside inside of a Section. */

    //     // Adding an empty Section to the document...
    //     $section = $phpWord->addSection();
    //     // Adding Text element to the Section having font styled by default...
    //     $section->addText(
    //         '"Learn from yesterday, live for today, hope for tomorrow. '
    //             . 'The important thing is not to stop questioning." '
    //             . '(Albert Einstein)'
    //     );

    //     /*
    //     * Note: it's possible to customize font style of the Text element you add in three ways:
    //     * - inline;
    //     * - using named font style (new font style object will be implicitly created);
    //     * - using explicitly created font style object.
    //     */

    //     // Adding Text element with font customized inline...
    //     $section->addText(
    //         '"Great achievement is usually born of great sacrifice, '
    //             . 'and is never the result of selfishness." '
    //             . '(Napoleon Hill)',
    //         array('name' => 'Tahoma', 'size' => 10)
    //     );

    //     // Adding Text element with font customized using named font style...
    //     $fontStyleName = 'oneUserDefinedStyle';
    //     $phpWord->addFontStyle(
    //         $fontStyleName,
    //         array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
    //     );
    //     $section->addText(
    //         '"The greatest accomplishment is not in never falling, '
    //             . 'but in rising again after you fall." '
    //             . '(Vince Lombardi)',
    //         $fontStyleName
    //     );

    //     // Adding Text element with font customized using explicitly created font style object...
    //     $fontStyle = new \PhpOffice\PhpWord\Style\Font();
    //     $fontStyle->setBold(true);
    //     $fontStyle->setName('Tahoma');
    //     $fontStyle->setSize(13);
    //     $myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
    //     $myTextElement->setFontStyle($fontStyle);

    //     // Saving the document as OOXML file...
    //     $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        

    //     // // Saving the document as ODF file...
    //     // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
    //     // $objWriter->save('helloWorld.odt');

    //     // // Saving the document as HTML file...
    //     // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
    //     // $objWriter->save('helloWorld.html');

    //     try {
    //         $objWriter->save(storage_path('helloWorld.docx'));
    //         // $file_signature1->move(public_path('certificate_design/school_certificates'), $new_image_name_signature1);
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }

    //     /* Note: we skip RTF, because it's not XML-based and requires a different example. */
    //     /* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */
    // return response()->download('MyDocument.docx');
        return view('admins.word.index');
        }


        public function store(Request $request)
    {
       $filename =  $request->get('filename');

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $header = $section->addHeader();
        
        $section = $phpWord->addSection();
        $text = $section->addText($filename);
        $text = $section->addText($request->get('new_message'));
        $text = $section->addText($request->get('email'));
        $text = $section->addText($request->get('number'),array('name'=>'Arial','size' => 20,'bold' => true));
        $footer = $section->addFooter();
        // $section->addImage("./images/Krunal.jpg");  
        $new_word_doc_name =  $filename. '.' .'docx';

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($new_word_doc_name);
        // $objWriter->move(public_path('documents/word'), $new_word_doc_name);
        return response()->download(public_path($new_word_doc_name));
    }

    // public function FunctionName(Type $var = null)
    // {
    //     $phpWord = new PhpOffice\PhpWord\PhpWord();
    //     $section = $phpWord->addSection();
    //     $header = $section->addHeader();
    //     $header->addText('This is my fabulous header!');
    //     $footer = $section->addFooter();
    //     $footer->addText('Footer text goes here.');
    //     $textrun = $section->addTextRun();
    //     $textrun->addText('Some text. ');
    //     $textrun->addText('And more Text in this Paragraph.');
    //     $textrun = $section->addTextRun();
    //     $textrun->addText('New Paragraph! ', ['bold' => true]);
    //     $textrun->addText('With text...', ['italic' => true]);
    //     $rows = 10;
    //     $cols = 5;
    //     $section->addText('Basic table', ['size' => 16, 'bold' => true]);
    //     $table = $section->addTable();
    //     for ($row = 1; $row >= 8; $row++) {
    //     $table->addRow();
    //     for ($cell = 1; $cell >= 5; $cell++) {
    //     $table->addCell(1750)->addText("Row {$row}, Cell {$cell}");
    //     }
    //     }
    //     $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    //     $objWriter->save('MyDocument.docx');
    // }
}
