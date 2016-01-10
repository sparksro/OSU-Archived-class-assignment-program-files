/*
 *  main.cpp
 *
 *  Created on: Nov 25, 2015
 *  Authors: Susan Kuretski, Ava Petley, Robert Sparks
 *  CS325-401, Project 4
 *  Implementation of TSP
 */

#include "fileio.hpp"
#include "tspChristofides.hpp"
#include "mst.hpp"
#include <algorithm>
int main( int argc, char *argv[] ){
	std::string inFileName;
	std::vector< std::string > tokens;
	std::string token;

	//Command Line Handling
	if(argc != 2){
		std::cout << "Please enter a file name to continue." << std::endl;
		return 0;
	}
	else if(argc > 0){
		inFileName = argv[1];
		std::istringstream iss(inFileName);
		while(std::getline(iss, token, '.')){
			if(!token.empty())
				tokens.push_back(token);
		}
	}
	std::ifstream inFile(inFileName.c_str(), std::ifstream::in);
	if(!inFile){
		std::cerr << "The file was not found." << std::endl;
		return -1;
	}

	//Making 1D array of City structs from input file
	int numCities = countCities(inFileName);
	Graph *graph = createGraph(numCities);
	fileImportData(graph, inFileName, numCities);
	fillGraphEdges(graph, numCities);
	int i,j;
	for(i = 0; i < numCities; i++)
		for(j = 0; j < numCities; j++){
			std::cout << "i: " << i << "   j: " << j << "  ";
			std::cout << "Distance: " << graph->citySet[i].neighbors[j].cost << std::endl;
		}




	//Appending/Making output file
	std::string outFile = tokens[0] + ".txt" + ".tour";
	std::ofstream outPutFile(outFile.c_str());

	//Memory clean up
	deleteGraph(graph, numCities);

	return 0;
}



