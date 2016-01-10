/*
 *  opt2.cpp
 *
 *  Created on: Dec 1, 2015
 *  Author: Ava Petley
 */

#include "mst.hpp"
#include <cmath>
//function to calculate distance for a tour given as an array
int totalDis(Graph *g, int Arr[], int aSize){
//variables for interating loops and holding distances
	int i;
	int j;
	int dist;
	int totald=0;
	int u;
	int v;
	for(i = 0; i<aSize;i++){
	//u gets from the array the starting vertex in an edges 
		u=Arr[i];
		//this is for the typical edged in the path
		if(i<(aSize-1)){
			j=i+1;
			v=Arr[j];
		}
		//this is for the edge that complete the circular path
		else{
			v=Arr[0];
		}
		//this gets the distance of the edge
		dist= g->citySet[u].neighbors[v].cost;
		//this will add up the edges and provide a total distance for the path
		totald=totald+dist;
	}
	//this returns the total distance
	return totald;
}
//this function will swap the vertices in a tour to check for inefficiences it takes the graph and the tour as an array
int swap(Graph *g, int Arr[], int aSize){
	//this temp array will hold the section of the tour that is effected
	int TempArr[4];
	//variables for loops
	int i;
	int j=0;
	//current is the current distance for the section under review
	int current;
	//this hold the the vertex being rearranged
	int val;
	//this is the total after the swap
	int newTotal;
	//loop variables
	int k=0;
	int m=1;
	//loop to travel through tour 
	while(k<(aSize-2)){
	//loop to fill temp arrray with the next section to look at
	for(i=0; i<4; i++){
		TempArr[i]=Arr[j];
		j++;
	}
	//*****************NOTE TO SELF double check this. might need to remove if statment
	if(m==1){
	current=totalDis(g, TempArr, 4);
	m=0;
	}
	//swapping values
	val = TempArr[2];
	TempArr[2]=TempArr[1];
	TempArr[1]=val;
	//distance of the swapped section
	newTotal=totalDis(g, TempArr, 4);
	//if new value is less distance than the current then it is added it replaces the old piece in the full tour
	if(newTotal<current){
		//**********************NOTE TO SELF this part needs examined 
		current=newTotal;
		//returns to starting point of altered section
		j=j-4;
		for(i=0; i<4; i++){
			Arr[j]=TempArr[i];
			j++;
		}
	}
	j=j-3;
	k++;
	}
	return newTotal;
}


