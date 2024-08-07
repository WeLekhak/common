<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDF Print Example</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bona+Nova+SC:ital,wght@0,400;0,700;1,400&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
  <style>
    #cover {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 48em;
      height: 70em;
    }
    #content {
      width: 40em;
      /* A4 size width */
      height: 60em;
      /* A4 size height */
      padding: 2em;

      background: linear-gradient(45deg, #8f032580 25%, transparent 21%) ,
      linear-gradient(315deg, #8f032580 25%, transparent 21%),
      linear-gradient(45deg, #8f0325 10%, transparent 11%),
      linear-gradient(315deg, #8f0325 10%, transparent 11%),
      linear-gradient(135deg, #8f032580 25%, transparent 21%) ,
      linear-gradient(225deg, #8f032580 25%, transparent 21%),
      linear-gradient(135deg, #8f0325 10%, transparent 11%),
      linear-gradient(225deg, #8f0325 10%, transparent 11%),
      radial-gradient(#8f0325 20%, transparent 21%);
      background-size: 3em 3em;
      background-color: #eef1e1;
      opacity: 1;

      background: linear-gradient(-45deg, #132bca99 20%, transparent 20% 80%, #132bca99 80% 100%), linear-gradient(45deg, #132bca99 20%, transparent 20% 80%, #132bca99 80% 100%), linear-gradient(-45deg, #fdfdfd 33%, transparent 33% 66%, #fdfdfd 66%), linear-gradient(45deg, transparent 33%, #132bca 33% 66%, transparent 66%);
      background-size: 2em 2em;
      background-color: #fdfdfd;
      opacity: 1;
      border: 0px solid #132bca99;
    }
    #certificate {
      background: white;
      font-family: "DM Serif Display", serif;
      font-weight: 500;
      font-style: normal;
      text-align: center;
      border: 1px solid #132bca99;
      height: 100%;
    }
    #name_certificate {
      padding-top: 8em;
    }
    #text_certificate1 {
      padding-top: 4em;
      font-size: 4em;
      color: #132bca;

    }
    #text_certificate2 {
      padding-top: 0;
      font-size: 2em;
      color: #132bca99;
    }
    #certificate_content {
      font-size: 1.5em;
      padding: 2em;
      text-align: justify;
      text-align-last: center;
      position: relative;
    }
    .main_content {
      color: #132bca;
      text-decoration: underline;
    }


    .sub_content {
      /*color: #132bca99;*/
    }
    .certificate_bottom {
      text-align: left;
      padding: 3em;
    }
  </style>
</head>
<body>
  <div id="cover">
    <div id="content">
      <div id="certificate">
        <div id="name_certificate">
          <span id="text_certificate1">CERTIFICATE</span>
          <br />
          <span id="text_certificate2">OF APPRECIATION</span>
        </div>
        <div id="certificate_content">
          <span class="sub_content">This is to certify that</span>
          <span class="main_content">Abhay Vishnu Khillare</span>
          <span class="sub_content">has demonstrated exceptional skill and creativity in writing and has been awarded for</span>
          <span class="main_content">Writing Best Articles</span>
          <span class="sub_content">for outstanding contributions in crafting engaging, insightful, and high-quality articles. Your dedication and expertise have set a high standard in the field</span>

        </div>
        <div class="certificate_bottom">
          <span>Date: 27<sup>th</sup> August 2024</span>
          <br />
          <span>Founder and CEO,</span>
          <br />
          <span>WeLekhak (Lekhak.in)</span>
        </div>
      </div>

    </div>
  </div>
  <button onclick="pdfPrinter.printPDF(document.getElementById('cover'))">Print PDF</button>
  <script>
    class PDFPrinter {
      async printPDF(element) {
        const {
          jsPDF
        } = window.jspdf;
        const pdf = new jsPDF('p', 'mm', 'a4');

        // Use html2canvas to capture the element as an image
        const canvas = await html2canvas(element);
        const imgData = canvas.toDataURL('image/png');

        // Add the image to the PDF
        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

        pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);

        // Save the PDF
        pdf.save('document.pdf');
      }
    }

    const pdfPrinter = new PDFPrinter();
  </script>
</body>
</html>