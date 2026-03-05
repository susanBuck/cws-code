# Import the modules we’ll need
from psychopy import core, visual, event
import random
import csv
import time

# Define a results string, initiating it with the column headers of our CSV file that will contain our results
results = 'characters,isWord,correct,reactionTime\n'

# Open and parse our word conditions CSV file
with open('conditions.csv', newline='') as csvfile:

    # Read the CSV contents, converting them to a list
    conditions = list(csv.reader(csvfile))
    
    # Remove the first item in the list which is the CSV header (characters,isWord)
    conditions.pop(0)
    
    print(conditions)

    # Shuffle the list
    random.shuffle(conditions)
    
    conditionsCount = len(conditions)

# Define the window
window = visual.Window(size=(800, 700), color='black')

# Define the instructions
welcome = '''
Welcome to the lexical decision task.

You are about to see a series of characters. 

If the characters make up a word, 
press the RIGHT arrow key.

If the characters do not make up a word, 
press the LEFT arrow key.

Press SPACE to begin.
'''

instructions = visual.TextStim(window, color='white', text=welcome, units='pix', height=20)

# Display the instructions and wait for the space bar to be hit to start
instructions.draw()
window.flip()
event.waitKeys(keyList=['space'])

# Begin trials
for index,condition in enumerate(conditions):

    characters = condition[0]
    isWord = int(condition[1])

    # Define the stimulus (word text)
    word = visual.TextStim(window, color='white', text=characters, units='pix', height=40)
    
    # Display the stimulus
    word.draw()
    window.flip()

    # Start timer
    startTime = core.getTime()

    # Listen for a left or right key response
    response = event.waitKeys(keyList=['right', 'left'])
    
    # Calculate reaction time
    reactionTime = core.getTime() - startTime
   
    # Check response accuracy
    if(isWord == 1 and response[0] == 'right'):
        correct = 1
    elif(isWord == 0 and response[0] == 'left'):
        correct = 1
    else:
        correct = 0
    
    # Append the results as an CSV string
    results += characters + ',' + str(isWord) + ',' + str(correct) + ',' + str(reactionTime) + '\n'
    
    # Pause before presenting next stimulus
    # If at the last condition, skip the pause
    if(index != conditionsCount - 1):
        pause = visual.TextStim(window, color='white', text='+', units='pix', height=40)
        pause.draw()
        window.flip()
        core.wait(1)
    

# Write the results to a .csv text file
with open('results-' + str(time.time()) + '.csv', 'w') as file:
    file.write(results)

# Also print the results to the console
print(results)    

# Exit message
exitText = visual.TextStim(window, color='white', text='Thank you for participating.\n\n Press SPACE to exit.', units='pix', height=20)
exitText.draw()
window.flip()
event.waitKeys(keyList=['space'])

# The next two lines ensure the PsychoPy application is properly terminated. 
# If you omit these lines, the window will still close when the script is done, but these
# lines that system resources associated with the window are released properly.
window.close()
core.quit()