document.addEventListener("DOMContentLoaded", function () {
  $("#btn-descarga").click(() => {
    const input = document.getElementById("pdf");
    html2canvas(input).then((canvas) => {
      let image = canvas.toDataURL("image/jpeg", 1.0);
      let doc = new jsPDF("p", "px", "letter");
      let pageWidth = doc.internal.pageSize.width;
      let pageHeight = doc.internal.pageSize.height;

      let widthRatio = pageWidth / canvas.width;
      let heightRatio = pageHeight / canvas.height;
      let ratio = widthRatio > heightRatio ? heightRatio : widthRatio;

      let canvasWidth = canvas.width * ratio;
      let canvasHeight = canvas.height * ratio;

      doc.addImage(image, "JPEG", -10, 20, canvasWidth , canvasHeight );
      let fileName = "prueba.pdf";
      doc.save(fileName);
    });
  });
});
