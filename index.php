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
// // Getting local file so that we can upload it to Azure
// $myfile = fopen($fileToUpload, "w") or die("Unable to open file!");
// fclose($myfile);

// # Upload file as a block blob
// echo "Uploading BlockBlob: ".PHP_EOL;
// echo $fileToUpload;
// echo "<br />";

// $content = fopen($fileToUpload, "r");

// //Upload blob
// $blobClient->createBlockBlob($containerName, $fileToUpload, $content);

// List blobs.
$listBlobsOptions = new ListBlobsOptions();
$listBlobsOptions->setPrefix("");

echo "These are the blobs present in the container: ";

do{
    $result = $blobClient->listBlobs($containerName, $listBlobsOptions);
    foreach ($result->getBlobs() as $blob)
    {
        echo $blob->getName().": ".$blob->getUrl()."<br />";
    }

    $listBlobsOptions->setContinuationToken($result->getContinuationToken());
} while($result->getContinuationToken());
echo "<br />";

// // Get blob.
// echo "This is the content of the blob uploaded: ";
// $blob = $blobClient->getBlob($containerName, $fileToUpload);
// fpassthru($blob->getContentStream());
// echo "<br />";
?>