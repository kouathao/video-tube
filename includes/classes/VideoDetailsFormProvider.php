<?php
class VideoDetailsFormProvider
{
    private $con;

    // initialize $con
    public function __construct($con)
    {
        $this->con = $con;
    }

    public function createUploadForm()
    {
        // call function within class with $this
        $fileInput = $this->createFileInput();
        $titleInput = $this->createTitleInput();
        $descriptionInput = $this->createDescriptionInput();
        $privacyInput = $this->createPrivacyInput();
        $createCategoriesInput = $this->createCategoriesInput();
        $createUploadButton = $this->createUploadButton();
        return "<form action='processing.php' method='POST'>
                    $fileInput
                    $titleInput
                    $descriptionInput
                    $privacyInput
                    $createCategoriesInput
                    $createUploadButton
                </form>";
    }

    private function createFileInput()
    {

        return "<div class='form-group'>
                    <label for='exampleFormControlFile1'>Your file</label>
                    <input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileInput' required>
                </div>";
    }

    private function createTitleInput()
    {
        return "
        <div class='form-group'>
        <input class='form-control' type='text' placeholder='Title' name='titleInput'>
        </div>
        ";
    }

    private function createDescriptionInput()
    {
        return "
        <div class='form-group'>
        <textarea class='form-control' placeholder='Description' name='descriptionInput' rows='3'></textarea>
        </div>
        ";
    }

    private function createPrivacyInput()
    {
        return "
        <div class='form-group'>
        <select class='form-control' name='privacyInput'>
        <option value='0'>Private</option>
        <option value='1'>Public</option>
        </select>
        </div>
        ";
    }

    private function createCategoriesInput()
    {
        $query = $this->con->prepare("SELECT * FROM categories");
        $query->execute();

        $html = "
        <div class='form-group'>
        <select class='form-control' name='categoryInput'>
        ";


        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["id"];
            $name = $row["name"];


            $html .= "<option value='$id'>$name</option>";
        }

        $html .= "</select>
        </div>";

        return $html;
    }

    private function createUploadButton()
    {
        return "<button type='submit' class='btn btn-primary' name='uploadButton'>Upload</button>";
    }
}