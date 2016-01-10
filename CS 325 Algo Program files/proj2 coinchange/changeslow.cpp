/*
 *  changeslow.cpp
 *
 *  Created on: Oct 23, 2015
 *  Author: Susie Kuretski
 */

#include <vector>
#include <climits>
#include "changeslow.hpp"
/* Description: Utilizes changeslow to execute for recursive coin
 * change problem
 * Pre-condition: accepts vector as initial coin denominations, vector to
 * store results, and initial coin amount (n)
 * Post-condition: returns int (minimum coins) and results has the coin denominations
 * reflective of the initial coin vector
 */
int recChangeslow(std::vector<int > &coins, std::vector<int > &results, int n){
	Change currentCoins;
	Change bestCoins;
	unsigned int i;
	for(i = 0; i < coins.size(); i++){
		currentCoins.coins.push_back(0);
		bestCoins.coins.push_back(0);
	}
	bestCoins.amount = INT_MAX;
	currentCoins.amount = 0;
	changeslow(n, coins, currentCoins, bestCoins);
	for(i = 0; i < coins.size(); i++)
		results.push_back(bestCoins.coins[i]);
	return bestCoins.amount;
}
/* Description: Recursive implementation of the coin change problem
 * Pre-condition: accepts initial amount (n) which is a positive integer,
 * vector of coin denominations, and Change struct of current set of coins and
 * the best set
 * Post-condition: returns the best set of coins from the starting
 * amount and coin denominations in form of Change struct (bestCoins)
 */
void changeslow(int n, std::vector<int > &coins, Change &currentCoins, Change &bestCoins){
	unsigned int i;
	if(n == 0){
		if(bestCoins.amount > currentCoins.amount){
			bestCoins.amount = currentCoins.amount;
			bestCoins.coins = currentCoins.coins;
		}
	}
	else{
		for(i = 0; i < coins.size(); i++){
			if(n >= coins[i]){
				Change updateCoins;
				updateCoins.amount = currentCoins.amount + 1;
				updateCoins.coins = currentCoins.coins;
				updateCoins.coins[i]++;
				changeslow(n - coins[i], coins, updateCoins, bestCoins);
			}
		}
	}
}



