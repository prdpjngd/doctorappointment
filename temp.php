<html>
<head>
    <title></title>

</head>
<body>
     <table id="tblCustomers" cellspacing="0" cellpadding="0">
        <tr>
            <th>Customer Id</th>
            <th>Name</th>
            <th>Country</th>
        </tr>
        <tr>
            <td>1</td>
            <td>John Hammond</td>
            <td>United States</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Mudassar Khan</td>
            <td>India</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Suzanne Mathews</td>
            <td>France</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Robert Schidner</td>
            <td>Russia</td>
        </tr>
    </table>
    <br />
    <input type="button" id="btnExport" value="Export" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
            $("body").on("click", "#btnExport", function () {
                html2canvas($('#tblCustomers')[0], {
                    onrendered: function (canvas) {
                        var data = canvas.toDataURL();
                        var docDefinition = {
                            content: [{
                                image: data,
                                width: 500
                            }]
                        };
                        pdfMake.createPdf(docDefinition).download("Table.pdf");
                    }
                });
            });
    </script>
</body>
</html>