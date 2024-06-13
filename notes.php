<?php 
session_start();
include 'database.php';


if(isset($_POST["submit"])){
    $title=$_POST["title"];
    $note=$_POST["note"];
    $ID=$_SESSION["ID"];

    $sql= "INSERT INTO notes (UserID,title,note) VALUES ('$ID','$title','$note')";
    $sqlres=mysqli_query($connect,$sql);
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title> NOTES | My notes</title>
        <link href="notes.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
        <h2 class="username"> WELCOME 
        <?php
        echo $_SESSION["FirstName"]." ";
        echo $_SESSION["LastName"];
        ?></h2>

    <button class=add onclick= "opennote()">
        add a note
    </button>

    <form id="noteForm" class="noteForm" method="post" style="display:none;"> 

    <input type="text" class=title placeholder="title" name="title">

    
    <textarea placeholder="Your note" class=note  name="note"></textarea>
    

    <input type="submit" value="save" class="submitn" name="submit" onclick="closenote()">
    <input type="reset" value="cancel" class="canceln" name="cancel" onclick="closenote()" >

    </form>
    
    <?php 
    $ID=$_SESSION["ID"];
    $sqlnotes="SELECT * FROM notes WHERE UserID= $ID";
    $sqlresult=mysqli_query($connect,$sqlnotes);
    $sqlnum=mysqli_num_rows($sqlresult);
    if($sqlresult && $sqlnum>0){
        while($note=mysqli_fetch_assoc($sqlresult)){  
    ?>
    <div class="notes">
        <h3><?php echo $note['title']?></h3>
        <p><?php echo $note['note']?></p>
        <form method="post">
        <button class="edit" name="edit" value=<?php echo $note['noteID']?> onclick="opennoteview(<?php echo $note['noteID'];?>);return false;"> Edit</button>
        <button value="<?php echo $note['noteID'] ?>" class="delete" name="cancel" onclick="closenoteview(<?php echo $noteID;?>)" > Delete </button>
        </form>

    </div>

    <?php 
            }
        }

        if (isset($_POST["edit"])){
            $noteID=$_POST["edit"];
            $sql="SELECT title,note FROM notes WHERE noteID=$noteID";
            $sqlres=mysqli_query($connect,$sql);
            $sqlnum=mysqli_num_rows($sqlres);
            if($sqlres && $sqlnum>0){
            $noteview=mysqli_fetch_assoc($sqlres)
        


        
    ?>


    <form id="noteFormview-<?php echo $noteID;?>" class="noteFormview" method="post" style="display:block;"> 

    <input type="text" class=title placeholder="<?php echo $noteview['title']?>" name="titlen">

    
    <textarea placeholder="<?php echo $noteview['note']?>" class=note  name="noten"></textarea>
   

    <button value="<?php echo $noteID ?>" class="submitn" name="save" onclick="closenoteview(<?php echo $noteID;?>)"> save changes</button>
    <input type="reset" value="discard" class="canceln" name="cancel" onclick="closenoteview(<?php echo $noteID;?>)" > 

    </form>
<?php 
        }}
                if(isset($_POST["save"])){
                    $noteID=$_POST["save"];
                    $titlen=$_POST["titlen"];
                    $noten=$_POST["noten"];
                    $sqln="UPDATE notes SET title='$titlen',note='$noten' WHERE noteID=$noteID";
                    $sqlr=mysqli_query($connect,$sqln);
                    if($sqlr){
                        echo "note updated successfully";
                    }
                    else{
                        echo "there is an error";
                    }
                }

                if(isset($_POST["cancel"])){
                    $noteID=$_POST["cancel"];
                    $sqld="DELETE FROM notes WHERE noteID=$noteID";
                    $sqlr=mysqli_query($connect,$sqld);
                    if($sqlr){
                        echo "note deleted successfully";
                    }

                    else{
                        echo "note deletion failed";
                    }
                }

        
        ?>
    <script>
        function opennote(){
            document.getElementById("noteForm").style.display="block";
        }

        function closenote(){
            document.getElementById("noteForm").style.display="none";
        }

        function opennoteview(noteID){
            document.getElementById("noteFormview-"+noteID).style.display="block";
        }
        
        function closenoteview(noteID){
            document.getElementById("noteFormview-"+noteID).style.display="none";
        }

    </script>
    </body>
</html>