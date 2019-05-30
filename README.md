# minesweeper
Minesweeper for 3750
2D Array with 9X9 with 10 mines

10 mines, generated with 2 random numbers at a time for the x and y coordinates

Check for -1, if -1 exists in coordinates for the random numbers generate two more, if they don't exist then decrement numBombs until 0, which creates a 2d array.

Stringify from 2d array into  the MYSQL database. 
GameBoard, user never sees
GameState, keeps track of the user selections thus far
Then data from gameboard and gamestate are pulled to redraw the table each time the user clicks a square (table)

This is done over and over until the user clicks on a -1.

-5 represents incorrect flag(this only happens if the user clicked a  -1)
-4 the actual bomb that was clicked to cause a loosing game
-3 untouched field
-2 has been flagged(right click)
-1 represents a bomb field, revealed
0-9 represents number of adjacent bombs to that square.

Recursive check for each click to see adjacent mines… if a field is checked and a mine is adjacent to that field, we no longer check the fields adjacent to that particular field.

Make sure to do out of bounds checks… 



**** Shen -  we need to figure out how to do the sha256 and salting with the sessions. 
****Austin - will do database
****Farris - Logic of building the table with the mine layouts and the counts



GameBoard - the actual board created with mines locations and adjacent mines
	0 - 8 - the count of number of adjacent bombs to each field 
	-1 is an actual bomb
GameState - User populated interactions 
	0 - No interactions yet
	1 - Left clicked to reveal adjacent mines and numbers of adjacent minds
	-1 - right click to designate user guess of where a mine exists
DisplayTable - is the combination of the actual game board and the user interaction thus far up until they loose the game. 
	-5 - the field was flagged but not an actual bomb, this is not revealed until       the user looses the game by clicking on a -1
	-4 - a The bomb that was clicked on to cause the loosing of the game
	-3 - Untouched field that has yet to be clicked on or designated with an adjacent bomb count.
	-2 - Flagged as a bomb by doing a right click, this is before a bomb is clicked, but is accurately flagged as being a bomb as well. 
	-1 - actual bomb
	0 - 8 - count of adjacent bombs
	
	Name pages
	Login.php - loops if the username/password is inaccurate, or username exists but wrong password… needs a login and create buttons
	Game.php - Updating through AJAX after logic.php is checked
	Logic.php - performs all the checks after each user move
	
	Style.CSS 
	logic.JS       AJAX is all built in here
