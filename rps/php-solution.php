<?php
$moves = [
    1 => 'Rock',
    2 => 'Paper',
    3 => 'Scissors'
];

# For this demo we randomly generate the player moves
# in a real application you’d want to collect this as input from the players
$playerA = rand(1, 3);
$playerB = rand(1, 3);

# Determine winner
if ($playerA == $playerB) {
    $result = 'Tie';
} elseif (($playerA + 1) % 3 == $playerB % 3) {
    $result = 'Player B wins';
} else {
    $result = 'Player A wins';
}
?>

<!doctype html>
<html lang='en'>

<head>
    <title>Rock, Paper, Scissors</title>
</head>

<body>
    <div id='playerA'>Player A: <?=$moves[$playerA]?></div>
    <div id='playerB'>Player B: <?=$moves[$playerB]?> </div>
    <div id='result'>Result: <?=$result?></div>
</body>

</html>