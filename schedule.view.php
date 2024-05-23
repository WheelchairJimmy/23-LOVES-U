<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manchetser United Fixtures</title>
    <link rel="icon" href="logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS */

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            text-align: center;
            flex-grow: 1;
        }

        .icons {
            margin-right: 20px;
        }

        .icons i {
            margin-left: 10px; /* Adjust as needed */
            cursor: pointer;
        }


        body {
            font-family: Arial, sans-serif;
            background-color: #E60026 ; /*Manc Red */
            color: #FFFFFF;
            padding: 20px;
            margin: 0;
        }
        h1 {
            text-align: center;
            
        }
        h1 img {
            margin-right: 10px;
            width: 50px; 
            height: auto;
            

        }
        table {
            width : 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td{
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #FFFFFF;
        }
        th {
            background-color: #000; /*black*/
        }
    
        footer{
            position:relative;
            bottom: 0;
            width: 100%;
            background-color: #000;
            color:#FFFFFF;
            padding: 5px;;
            overflow-x: auto;
            z-index: 1000;
        }

        .footer-content {
            white-space: nowrap;
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            animation: slide 15s linear infinite;
        
        }

        .footer-content p {
            display: inline-block;
            margin-right: 20px;
        }
       
        @keyframes slide {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(100%); /* Slide content to the left */
    }
}
            
            </style>
            </head>
            <body>
            <div class="header-container">
                <h1><img src="logo.png" alt="Manchester United Logo">Manchester United Fixtures</h1>
                <div class="icons">
                    <i class="fas fa-moon" onclick="changeBackgroundColor()"></i>
                    <i class="fas fa-sun" onclick="resetBackgroundColor()"></i>
                </div>
            </div>



<table> 
    <tr>
        <th>Date</th>
        <th>Competition</th>
        <th>Opposition</th>
        <th>Venue</th>
    </tr>
   


</table>
<div id="prediction-poll">
    <h2>Predict Our Game v Burnley!:</h2>
    <form id="prediction-form" action="poll.php" method="post">
        <label for="prediction">Predict Our Game v Burnley!:</label><br>
        <input type="radio" id="win" name="prediction" value="win">
        <label for="win">Win</label><br>
        <input type="radio" id="lose" name="prediction" value="lose">
        <label for="lose">Lose</label><br>
        <!-- Add the button for Draw -->
        <input type="radio" id="draw" name="prediction" value="draw">
        <label for="draw">Draw</label><br>
        <!-- End of button for Draw -->
        <input type="submit" value="Submit Prediction">
    </form>
</div>


   <div id="match-facts">
    <h2> Match Facts </h2>
    <ul>
        <li>With 32 semi-final appearances, Manchester United holds a strong FA Cup record. They aim for a record 22nd final, surpassing Arsenal's current mark.</li>
        <li>In just their second semi-final, Coventry City's 19 goals this season lead all teams. Their attack poses a challenge for Manchester United.</li>
        <li>United Recent Form : WDLDD</li>
        <li>Coventry Recent Form : WLWLL</li>
    </ul>
   </div>
   
   
   <footer>
    <div class="footer-content">
        <p>Lisandro Martinez and Marcus Rashford are back in Team Training</p>
        <p>Follow our Instagram : @UnitedLol</p>
        <p>Mason Mount has suffered an injury and is OUT of Arsenal Game</p>
    </div>
   </footer>


   <script>

const api_key = "792b1e7aad5fd2d0f10b9187ff19f109";

function changeBackgroundColor() {
    document.body.style.backgroundColor = "#020202"; 
}

function resetBackgroundColor() {
    document.body.style.backgroundColor = "#E60026";
} 

document.getElementById("prediction-form").addEventListener("submit", function(event) {
    event.preventDefault(); 
    alert("Thank you for your prediction!"); 
});

fetch('https://v3.football.api-sports.io/fixtures?season=2024&league=45', {
    headers: {
        'x-rapidapi-key': api_key
    }
})
.then(response => response.json())
.then(data => {
    console.log("API response:", data);
    const fixtures = data.response;
    const table = document.querySelector('table');
    fixtures.forEach(fixture => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${new Date(fixture.fixture.date).toLocaleDateString()}</td>
            <td>${fixture.league.name}</td>
            <td>${fixture.teams.home.name} vs ${fixture.teams.away.name}</td>
            <td>${fixture.fixture.venue.name}</td>
        `;
        table.appendChild(row);
    });
})
.catch(error => {
    console.error('Error fetching fixture data:', error);
});
        </script>


    </body>
</html>



