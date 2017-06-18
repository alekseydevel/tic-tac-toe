[![Build Status](https://travis-ci.org/alekseydevel/tic-tac-toe.svg?branch=master)](https://travis-ci.org/alekseydevel/tic-tac-toe)
# tic-tac-toe
coding challenge.

CLI Prototype of Tic-Tac-Toe game ("X and 0")

Rule: game is finished if a line is full of the same symbols ("X" or "0")

Options:
- Size of field: 3x3
- Players` implementation is on the stage of prototype.

Installation:
- install PHP (>= 7.0)
- clone the repo
- run `composer install`
- run `vendor/phpunit/phpunit/phpunit --colors=auto tests/`
- for using app run commands below (`php index.php game:start`)

Commands:

1. game:start - starts app with initial data (empty grid 3x3 + several filled cells)        
2. game:object:place {row} {col} sets random symbol ("X" or "0") in the cell with provided params` values
3. game:terminate - terminate the game (clear the grid, clear temporary storage)

Future milestones (improvements):
1. Refactoring + unit testing
2. Players` env
3. Saving snapshots of game(-s) (players, cells, etc)
4. Different version support
5. Docker
6. REST
7. Behat/Codeception