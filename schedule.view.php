<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manchester United Fixtures</title>
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
            background-color: #E60026; /* Manchester United Red */
            color: #FFFFFF;
            padding: 20px;
            margin: 0;
        }

        h1 img {
            margin-right: 10px;
            width: 50px; 
            height: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 5px;
            text-align: left;
            border-bottom: 1px solid #FFFFFF;
        }

        th {
            background-color: #000; /* Black */
        }

        .coverage-list {
            list-style-type: none;
            padding: 0;
        }

        .coverage-item {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #000; /* Ensure text is readable on light background */
        }

        .coverage-item span {
            font-weight: bold;
        }

        footer {
            position: relative;
            bottom: 0;
            width: 100%;
            background-color: #000;
            color: #FFFFFF;
            padding: 5px;
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

    <div id="lineup-container"></div>
    <div id="statistics-container"></div>
    <p id="error-message"></p>

    <footer>
        <div class="footer-content">
            <p>Lisandro Martinez and Marcus Rashford are back in Team Training</p>
            <p>Follow our Instagram: @UnitedLol</p>
            <p>Mason Mount has suffered an injury and is OUT of Arsenal Game</p>
        </div>
    </footer>

    <script>
        const api_key = "792b1e7aad5fd2d0f10b9187ff19f109";
        const fixture_id = "1197145";
        const team_id = "33";

        // Fetch and display lineup
        fetch(`https://v3.football.api-sports.io/fixtures/lineups?fixture=${fixture_id}&team=${team_id}`, {
            method: "GET",
            headers: {
                "x-apisports-key": api_key
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.response && data.response.length > 0) {
                const lineup = data.response[0].startXI;
                displayLineup(lineup);
            } else {
                document.getElementById('lineup-container').innerHTML = '<p>No lineup data available.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching lineup data:', error);
            document.getElementById('lineup-container').innerHTML = '<p>Error fetching data.</p>';
        });

        function displayLineup(lineup) {
            const container = document.getElementById('lineup-container');
            const table = document.createElement('table');

            const headerRow = document.createElement('tr');
            const headers = ['Player', 'Position'];
            headers.forEach(headerText => {
                const th = document.createElement('th');
                th.textContent = headerText;
                headerRow.appendChild(th);
            });
            table.appendChild(headerRow);

            lineup.forEach(player => {
                const row = document.createElement('tr');
                const nameCell = document.createElement('td');
                nameCell.textContent = player.player.name;
                const positionCell = document.createElement('td');
                positionCell.textContent = player.player.pos;

                row.appendChild(nameCell);
                row.appendChild(positionCell);
                table.appendChild(row);
            });

            container.appendChild(table);
        }

        // Fetch and display match statistics
        fetch(`https://v3.football.api-sports.io/fixtures/statistics?fixture=${fixture_id}`, {
            method: "GET",
            headers: {
                "x-apisports-key": api_key
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.response && data.response.length > 0) {
                const statistics = data.response;
                displayStatistics(statistics);
            } else {
                document.getElementById('statistics-container').innerHTML = '<p>No statistics data available.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching statistics data:', error);
            document.getElementById('statistics-container').innerHTML = '<p>Error fetching data.</p>';
        });

        function displayStatistics(statistics) {
            const container = document.getElementById('statistics-container');
            statistics.forEach(teamStats => {
                const teamName = teamStats.team.name;
                const stats = teamStats.statistics;
                
                const teamHeader = document.createElement('h2');
                teamHeader.textContent = teamName;
                container.appendChild(teamHeader);

                const table = document.createElement('table');
                stats.forEach(stat => {
                    const row = document.createElement('tr');
                    const statNameCell = document.createElement('td');
                    statNameCell.textContent = stat.type;
                    const statValueCell = document.createElement('td');
                    statValueCell.textContent = stat.value;

                    row.appendChild(statNameCell);
                    row.appendChild(statValueCell);
                    table.appendChild(row);
                });

                container.appendChild(table);
            });
        }

        function changeBackgroundColor() {
            document.body.style.backgroundColor = "#333"; /* Dark mode */
            document.body.style.color = "#FFF";
        }

        function resetBackgroundColor() {
            document.body.style.backgroundColor = "#E60026"; /* Original background color */
            document.body.style.color = "#FFF";
        }
    </script>
</body>
</html>