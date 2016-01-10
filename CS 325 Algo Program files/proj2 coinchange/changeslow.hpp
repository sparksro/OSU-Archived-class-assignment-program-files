/*
 * changeslow.h
 *
 *  Created on: Oct 23, 2015
 *  Author: Susie Kuretski
 */

#ifndef CHANGESLOW_H_
#define CHANGESLOW_H_

struct Change{
	int amount;
	std::vector<int > coins;
};

int recChangeslow(std::vector<int > &coins, std::vector<int > &results, int n);
void changeslow(int n, std::vector<int > &coins, Change &currentCoins, Change &bestCoins);


#endif /* CHANGESLOW_H_ */
