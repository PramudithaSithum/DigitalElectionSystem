
<!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="utf-8">
    <title>Election </title>
    <style>
        
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins',sans-serif;
  }
  body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
    background: linear-gradient(to bottom, #78d8ed, #e143e4);
}

      .popup{
      width:400px;
      background: #fff;
      border-radius: 50px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%,-50%);
      text-align: center;
      padding: 0 30px 30px;
      color:#333;
    }
    .popup img{
      width:100px;
      margin-top: -50px;
      border-radius: 50%;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    .popup h2{
      font-size: 40px;
      font-weight: 500;
      margin: 30px 0 10px;

    }
    
.popup button {
  padding: 10px 20px;
  background-color: #29870c;
  color: #f3f3f3;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  position: relative;
  margin-top: 10%;
}

.popup button:hover {
  background-color: #cf3c3c;
}
    
        </style>
        
       
</head>
<body>
    <div class="popup">
        <img src="tick.png">
        <h2>Thank you!</h2>
        <p> Your details has been successfully submitted.Thanks!</p>
       
        <a href="addelection.php"><button type="button">OK</button></a>

        </form>
             
      </div>
</body>      



     

<?php
echo '<a href="index.php">
     <input type="button">
 </a>';
?>
