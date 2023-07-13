<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigilant</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>*{background:#090619;}.form-control {max-width:300px;}</style>
</head>
<body>
    <div class="">
        <a href="#"><img src="assets/vigillant.svg" alt="" width="250"></a>
        <br><br>
        <a href="src/get-yt-dlp.php"><button class="btn btn-primary">Get Core (yt-dlp)</button></a>
        <br><br>
        <div class="input-group mb-3">
            <form method="POST" action="src/get-data.php" class="d-flex">
                <input type="text" name="url" class="form-control" placeholder="Insira um canal ou vídeo" style="border-radius: 5px 0 0 5px; width:300px;">
                <span><input type="submit" class="btn btn-primary" style="border-radius: 0 5px 5px 0;"></span>
            </form>
        </div>
    </div>
</body>
</html>
