import random

moves = {
    1: 'Rock', 
    2: 'Paper', 
    3: 'Scissors'
}

# For this demo we randomly generate the player moves 
# in a real application you’d want to collect this as input from the players
playerA = random.randint(1, 3)
playerB = random.randint(1, 3)

# Determine winner
if (playerA == playerB):
    result = 'Tie'
elif ((playerA + 1) % 3 == playerB % 3):
    result = 'Player B wins'
else:
    result = 'Player A wins'
    
print('Player A: ' +  str(moves[playerA]))
print('Player B: ' + str(moves[playerB]))
print('Result: ' + str(result))