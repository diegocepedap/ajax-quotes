<html>
<head>
  <title>AJAX Quotes</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Tulpen+One&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@700&display=swap');

    /* CSS to hide the quote container initially and apply fade-in animation */
    #quoteContainer {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-shadow: 4px 4px 4px #0000ff; /* Change the color to red (#ff0000) */
      font-size: 24px;
      font-family: "Qwitcher Grypen", sans-serif;
    }

    /* CSS for the fade-in animation */
    .fade-in {
      animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    body {
      background-color: #f0f8ff; /* Light blue background */
      margin: 0;
    }

    .content {
      text-align: center;
      font-family: "times new roman", sans-serif;
    }

  </style>
</head>
<body>
  <div class="content">
  <h1>AJAX Quotes</h1>
  <p>This webpage is a cool place where you can find random quotes. It keeps showing you new quotes every few seconds. The quotes have special styles and designs, making them look cool on the screen. The background is a pleasant light blue color.  If something goes wrong and a quote can't be shown, the website will tell you. It's a fun way to enjoy different quotes and the page looks pretty with its animations.</p>
   </div>
  <div id="quoteContainer">Quote goes here</div>
  <script>

    var counter = 0;
    function getRandomQuote() {

      var fonts = ["Qwitcher Grypen","Tulpen One","Shadows Into Light"];

      var xhr = new XMLHttpRequest();
      xhr.open('GET','random_quotes.php',true);

      xhr.onload = function(){
        //code on return of data goes here
        if(xhr.status >= 200 && xhr.status < 300){//good data returned, show it!
          var quoteContainer = document.querySelector("#quoteContainer");
          quoteContainer.innerText = xhr.responseText;
          quoteContainer.style.fontFamily = fonts[counter];
          counter++;
          if(counter >= fonts.length){
            counter = 0;
          }

          quoteContainer.classList.add("fade-in");

          setTimeout(function(){
            quoteContainer.classList.remove("fade-in");
          },1000);
        }else{//something went wrong, give feedback
          document.querySelector("#quoteContainer").innerText = "failed to fetch quote" + xhr.status;
        }
      };

      xhr.onerror = function(){
        //code on error goes here
        alert("oh oh!");
      };

      //sends data to server 
      xhr.send();

    }

    function displayRandomQuote(){
      //Initial page load
      getRandomQuote();

      //run again at intervals
      setInterval(getRandomQuote,5000);
    }
    //run on page load
    displayRandomQuote();
  </script>
</body>
</html>