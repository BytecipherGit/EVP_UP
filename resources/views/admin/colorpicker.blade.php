<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
</head>
<body>
    <div class="form-group">
        <label>Theme Primary Color</label>
        <input class="form-control" type="text" name="primary_color" id="primary_color">
        <strong class="error" id="primary_color-error"></strong>
    </div>
    
    <div class="container">
        <h1>Bootstrap Color Picker Plugin Example</h1> 
        <div id="cp2" class="input-group colorpicker-component"> 
          <input type="text" value="#00AABB" class="form-control" /> 
          <span class="input-group-addon"><i></i></span>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cp2').colorpicker();
            $('#primary_color').colorpicker();
        });
        
    </script>
</body>
</html>