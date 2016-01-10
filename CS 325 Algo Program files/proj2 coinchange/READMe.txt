CoinChange.cpp

option 1
To compile use g++ changeslow.cpp coinChange.cpp -o coinChange  
lanch with ./coinChange <fileNameToOpen.txt>
If you forget the file name it will remind you.

option 2
use the make file.  The compiled name for the file is proj2 so launch with ./coinChange
<fileNameToOpen.txt>

Both cases will output to <sourcfileName>change.txt

Notes: 
1. Running the brute force algorithm (our first) takes a very long time to complete.  You may not want to run this on flip.  We have provided a smaller value file called Coin2.txt and it will handle it fine.  If you want to run Coin1.txt I would suggest commenting out the code for the first algorithm.

2. The timing function does not work on flip and just reports zeros but does
on other Linux set ups.

3. You can make clean to remove .o files if you would like.


