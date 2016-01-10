/*
 *  coinChange.cpp
 *
 *  Created on: Oct 20, 2015
 *  Authors:
 *  	Susan Kuretski
 *  	Ava Petley
 *  	Robert Sparks
 *  Class:
 *  	CS325-401
 *  	Project Group 2
 *  Assignment:
 *  	Project 2: Coin change
 *  Description:
 *  	For this project, you will investigate the coin change problem:
 *		Given coins of denominations (value) 1 = v1 < v2< … < vn, we wish
 *		to make change for an amount A using as few coins as possible. Assume
 *		that vi’s and A are integers. All values of A will have a solution since v1= 1.
 */

#include <iostream>
#include <fstream>
#include <sstream>
#include <vector>
#include <climits>
#include <ctime>
#include <algorithm>
#include "changeslow.hpp"

using namespace std;
typedef vector<int> vect;

void fileImportData(vector<vector<int> >& v, string filename, int linesIn);
void printInput(string name, vector<vector<int> >& vecTor, ostream &outPutFile, ifstream &inFile,
		int numLines, string inFileName, string outFile);
int CoinChange3(int amount, vector <int> &d, int C[], int s[]);
int Greedy_algo(vector <int> &A, int total, int Size, vector <int> &c);

int main( int argc, char *argv[] ){

 if (argc != 2 )
    {
        cout << "Please enter a file name to continue." << endl;
        return 0;
    }

 // take in the command line and parse it for later use
 //string inFileName = "Coin1.txt";
     string inFileName;//infile is the file that will be opened and read from
     vector< string > tokens;
     string token;

     if (argc > 0)
     {
         inFileName = argv[1];
         istringstream iss(inFileName);


         while (getline(iss, token, '.'))
         {
            if (!token.empty())
                tokens.push_back(token);// tokens[o] ist the split string to use in the output file name.
         }
     }

// *********   txt file input and prep for reading in arrays  **********

    int numOfLines = 0;
    string line;
    //open the file
        ifstream inFile(inFileName.c_str(), ifstream::in);        ///<-don't change file name here
        if (!inFile)
        {
            cerr << "The file was not found!" << endl;
            return -1;
        }
    // get the number of lines in the file
        while (getline(inFile, line))
            ++numOfLines;
        inFile.close();    // reset for the next round
        if(numOfLines%2 != 0)
        	numOfLines--;
    //make  mulit vector for use with algorithms - source data.
        vector<vector< int > > vecTor(numOfLines, vect() ); //Vectors for use with algorithms - source data.
    //import the data
        fileImportData(vecTor, inFileName, numOfLines);

    // timing stuff set up
        float start_time = 0;
        float end_time = 0;
        float elapsed_time = 0;

    //******* Make the file name and open it for writing **********

        string outFile = tokens[0] + "change.txt";
        ofstream outPutFile(outFile.c_str());
        string func1Name = "Brute Force or Divide and Conquer";
        string func2Name = "Greedy Algorithm";
        string func3Name = "Dynamic Programming";


//***********************************  function 1 *************************************************//
        printInput(func1Name, vecTor, outPutFile, inFile, numOfLines, inFileName, outFile);

        int i;
        unsigned int y, z;
        for(i = 0; i < numOfLines; i++){
        	int minCoins;
        	std::vector< int > coinDenom;
        	std::vector< int > results;
        	int inputCoinAmount = vecTor[i+1][0];
        	for(y = 0; y < vecTor[i].size(); y++ ){
        		coinDenom.push_back(vecTor[i][y]);
        	}
        	start_time = clock();
        	minCoins = recChangeslow(coinDenom, results, inputCoinAmount);
        	end_time = clock();
        	elapsed_time = end_time - start_time;
        	outPutFile << "[";
        	cout << "[";
        	for(z = 0; z < results.size(); z++){
        		if(z < results.size() - 1){
        			cout << results[z] << ", ";
        			outPutFile << results[z] << ", ";
        		}
        		else{
        			cout << results[z];
        			outPutFile << results[z];
        		}
        	}
        	outPutFile << "]" << endl;
        	cout << "]" << endl;
        	outPutFile << minCoins << endl;
        	std::cout << minCoins << endl;
        	cout << "Execution time " << fixed << elapsed_time / CLOCKS_PER_SEC << " sec" << endl;
        	outPutFile << "Execution time " << fixed << elapsed_time / CLOCKS_PER_SEC << " sec" << endl;
        	i++;
        }
        cout << endl;


 //***********************************  function 2 *************************************************//
        //Call function 2
  printInput(func2Name, vecTor, outPutFile, inFile, numOfLines, inFileName, outFile);
  int k;
  int m;
  int h;
  int l;
  vect catcher;
  vect vOne;
  int total;
  int vecTorXsize;
  for(k=0;k<numOfLines;k++){
    m=0;
    vecTorXsize = vecTor[k].size();
    for(l = 0; l < vecTorXsize; l++){
      vOne.push_back(vecTor[k][l]);
    }
    total=vecTor[k+1][0];
    start_time = clock();
    m=Greedy_algo(vOne, total, vecTorXsize, catcher);
    end_time = clock();
    elapsed_time = end_time - start_time;
        cout<<"[";
    outPutFile<<"[";
    for(h=(vecTorXsize-1); h>=0; h--){
      cout<<(catcher[h]);
      outPutFile<<catcher[h];
      if(h!=0){
        cout<<",";
        outPutFile<<",";
      }
    }
    catcher.clear();
    vOne.clear();
    cout<<"]"<<endl;
    outPutFile<<"]"<<endl;
    outPutFile << m << endl;
    cout<<"["<<m<<"]"<<endl;
    outPutFile << "Execution time " << fixed << elapsed_time / CLOCKS_PER_SEC << " sec" << endl;
    cout << "Execution time " << fixed << elapsed_time / CLOCKS_PER_SEC << " sec" << endl;
    k++;
  }



//***********************************  function 3 *************************************************//
      //Call function 3
     printInput(func3Name, vecTor, outPutFile, inFile, numOfLines, inFileName, outFile);
        //function call for output goes here
        i = 0;
        int j = 0;

        for(;i < numOfLines;i++)
        {
            //move multi dem vector data into singles for purposes of the loop
            vect denominations;
            j=0;
            int amount = vecTor[i+1][0];
            for(; j < int(vecTor[i].size()); j++ ){
                denominations.push_back(vecTor[i][j]);
            }

            int sizeOfD = denominations.size();
            int *C = new int[amount+1];
            int *s = new int[amount+1];

            //conditional adder to correct for either forward of backward direction of array
            bool swaped = false;
                if(denominations[0] > denominations[sizeOfD-1]){
                    reverse( denominations.begin(), denominations.end() );
                    swaped = true;
                }
            // call the helper function
            start_time = clock();
            int ans = CoinChange3(amount, denominations, C, s);
            end_time = clock();
            elapsed_time = end_time - start_time;
            vect cnt (sizeOfD,0);
            int k = amount;
            //count each coin that it takes to make the total
            while(k) {
                for(int l = 0; l < int(denominations.size());l++)
                {
                   if (denominations[s[k]] == denominations[l]){
                       cnt[l] = cnt[l] +1;
                    }
                }
                k = k - denominations[s[k]];
            }

            //if it was reversed earlier swap it back
            if (swaped){
                reverse(cnt.begin(), cnt.end());}
            outPutFile << "[";
            cout << "[";
                    j = 0;
                    int l = 0;
                    for (; j< int(cnt.size());j++){
                        cout <<cnt[l];
                        outPutFile <<cnt[l];
                        if ( l < int(cnt.size() -1) ){
                                cout <<", ";
                                outPutFile <<", ";
                        }
                        l++;
                    }
                    outPutFile << "]" << endl;
                    cout << "]" << endl;
                    outPutFile << "[" << ans << "]" << endl;
                    cout << "[" << ans << "]" << endl;
                    cout << "Execution time " << fixed << elapsed_time / CLOCKS_PER_SEC << " sec" << endl;
                    outPutFile << "Execution time " << fixed << elapsed_time / CLOCKS_PER_SEC << " sec" << endl;
            delete[] C;
            delete[] s;
        i++; //because we want to go every other line
        }
    outPutFile.close();
	return 0;
}
//****** function: fileImport Data - takes a vector name, a filename to open and the number of lines in that file as params
void fileImportData(vector<vector<int> >& v, string filename, int linesIn)
{
	string line;

	ifstream inFile(filename.c_str(), ifstream::in );
	int i = 0;
	for (i = 0; i < linesIn; i++) {
		int n;
		//get the line and parse so its ready for use
		getline(inFile, line, '\n');
		line.c_str(); //convert to cstring s
		int j = 0;
		for (j = 0; j < int(line.size()); j++) {
			if (line[j] == ',' || line[j] == '[' || line[j] == ']')
				line[j] = ' ';
		}
		//string tempString = line;
		stringstream ss(line);
		while (ss >> n) {
			v[i].push_back(n);
		}
	}
	inFile.close();
}

void printInput(string funcName, vector<vector<int> >& vecTor, ostream &outPutFile, ifstream &inFileName,
	int numLines, string inName, string outName){
	cout<<endl;
	outPutFile<<endl;
	cout << "#### " << funcName << " ####" << endl;
	outPutFile << "#### " << funcName << " ####" << endl;
	cout<<endl;
	outPutFile<<endl;
    cout << inName << " Data"<< endl;
    outPutFile << inName << " Data"<< endl;
    int i = 0, j = 0;
    for(;i<numLines;i++)
    {
        cout <<"[";
        outPutFile<<"[";
         for(j = 0; j < int(vecTor[i].size()); j++ ){
               cout << vecTor[i][j];
               outPutFile << vecTor[i][j];
                    if (j < int(vecTor[i].size()-1) ){ cout <<", ";
                     outPutFile <<", ";}
                     }
          cout << "]"<<endl;
          outPutFile << "]"<<endl;
    }
    cout<<endl;
    outPutFile<<endl;
    cout << outName << endl;
    outPutFile << outName << endl;
}

// helper function for DP algorithm 3
int CoinChange3(int amount, vector <int> &d, int C[], int s[])
{
    int sizeD = d.size();
    C[0] = 0;
    for(int j = 1; j <= amount; j++) {
	C[j] = INT_MAX;
	for(int i = 0; i < sizeD; i++) {
	    if(j >= d[i] && 1 + C[j-d[i]] < C[j] ) {
		C[j] = 1 + C[j-d[i]];

		s[j] = i;
	    }
        }
    }
    return C[amount];
}

int Greedy_algo(vector<int> &A, int total, int Size,vector<int>&c ){
  int m;
  int i;
  int loopvar = Size-1;
  int numof;
  for(i=loopvar; i>=0; i--){
    numof = total/A[i];
    total=total%A[i];
    m=m+numof;
    c.push_back(numof);
  }

return m;
}
