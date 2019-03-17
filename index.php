<?php

require_once 'vendor/autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

$connectionString = "DefaultEndpointsProtocol=https;AccountName=abdusystorage;AccountKey=GjfGa4hpyL8ffkvyX2ogK6pXdLyfOn21rqY8SN2V8pCzP1rzFXdegug3sQl0pkwOMR4I6Ys3aBj6CK55L4X7Sw==";

// Create blob client.
$blobClient = BlobRestProxy::createBlobService($connectionString);

$createContainerOptions = new CreateContainerOptions();
$createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);
$createContainerOptions->addMetaData("author", "Muhammad Abdusy Syukur");
$createContainerOptions->addMetaData("email", "ahmadci3@gmail.com");

$containerName = "abdusycontainer";

try {
    // Create container.
    $blobClient->createContainer($containerName, $createContainerOptions);
    
}
catch(ServiceException $e){
    
}

$listBlobsOptions = new ListBlobsOptions();

echo "<br />";

?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <title>MACD - Submission 2</title>
    </head>
    <body>
        <div class="container">
            <h1>DICODING - MENJADI AZURE CLOUD DEVELOPER</h1>
            <h3>Submission 2 - Azure Storage</h3>
        </div>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">URL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        do{
                            $result = $blobClient->listBlobs($containerName, $listBlobsOptions);
                            foreach ($result->getBlobs() as $blob)
                            {
                                echo "<tr><td>$i</td><td><a href=\"".$blob->getUrl()."\">".$blob->getName()."</a></td><td>".$blob->getUrl()."</td></tr>";
                                $i++;
                            }
                        
                            $listBlobsOptions->setContinuationToken($result->getContinuationToken());
                        } while($result->getContinuationToken());
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>