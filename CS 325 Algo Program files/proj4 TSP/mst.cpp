/*
 *  mst.cpp
 *
 *  Created on: Nov 29, 2015
 *  Author: Susie Kuretski, Ava Petley, Robert Sparks
 *  Description: Implementation of finding MST with a graph
 */


// MST using Prim

#include "mst.hpp"
#include <cmath>
#include <algorithm>
#include <vector>
#include <cstdlib>

Graph* createGraph(int size){
	Graph *newGraph = new Graph[size];
	newGraph->citySet = new City[size];
	return newGraph;
}

//Distance (edge weight) calculation
int distance(struct City u, struct City v){
	int dist = 4;
	int dx = pow((float)(u.x - v.x), 2);
	int dy = pow((float)(u.y - v.y), 2);
	dist = (floor((float) (sqrt(dx + dy)) + 0.5));	//0.5 to compensate for rounding
	return dist;
}

void fillGraphEdges(Graph *g, int numCities){
	int i, j;
	for(i = 0; i < numCities; i++)
		for(j = 0; j < numCities; j++){
			City *pointerA = &g->citySet[i];
			City *pointerB = &g->citySet[j];
			g->citySet[i].neighbors[j].source = pointerA;
			g->citySet[i].neighbors[j].destination = pointerB;
			g->citySet[i].neighbors[j].cost = distance(g->citySet[i], g->citySet[j]);
		}
}

bool compare(City a, City b){
	return a.visited > b.visited;
}

/***************   TO-DO   ********************** */

//City visited is set to INT_MAX initially (infinity)
//City parent is set to INT_MIN initially (NIL)
//See CLRS page 634
void prim(Graph *g, int num){
	//Set starting city key to zero (visited == key)
	g->citySet[0].visited = 0;

	//Resulting MST
	std::vector<Edge> mst;

	//Priority Queue
	std::vector<City> priorityQueue;

	//Make priority queue
	int i;
	for(i = 0; i < num; i++){
		priorityQueue.push_back(g->citySet[i]);
	}
	//Sort priority queue into min heap
	std::sort(priorityQueue.begin(), priorityQueue.end(), compare);

	//While queue is not empty
	while(priorityQueue.size() > 0){
		//Front of queue is the minimum key
		City a = priorityQueue.front();
		//Extract min
		pop_front(priorityQueue);
		//For each v in in G adjacent to u
			//if v element of Q and weight(u,v) < v.key
				//v.parent = u
				//v.visited = w(u, v)
				//add result to mst
	}
}

//Pops front of queue
void pop_front(std::vector<City>){

}

//Memory clean up for dynamic arrays
void deleteGraph(Graph *g, int numCities){
	if(g != 0){
		int i;
		for(i = 0; i < numCities; i++)
			delete [] g->citySet[i].neighbors;
		delete [] g->citySet->neighbors;
		delete [] g->citySet;
		delete [] g;
	}
}


