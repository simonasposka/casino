<?php

namespace App\Service;

use Exception;
use Ramsey\Uuid\Uuid;

class SportsApi
{
    protected array $nbaTeams = [
        'Boston Celtics',
        'Brooklyn Nets',
        'New York Knicks',
        'Philadelphia 76ers',
        'Toronto Raptors',
        'Golden State Warriors',
        'Los Angeles Clippers',
        'Los Angeles Lakers',
        'Phoenix Suns',
        'Sacramento Kings',
        'Chicago Bulls',
        'Cleveland Cavaliers',
        'Detroit Pistons',
        'Indiana Pacers',
        'Milwaukee Bucks',
        'Dallas Mavericks',
        'Houston Rockets',
        'Memphis Grizzlies',
        'New Orleans Hornets',
        'San Antonio Spurs',
        'Atlanta Hawks',
        'Charlotte Bobcats',
        'Miami Heat',
        'Orlando Magic',
        'Washington Wizards',
        'Denver Nuggets',
        'Minnesota Timberwolves',
        'Oklahoma City Thunder',
        'Portland Trail Blazers',
        'Utah Jazz'
    ];

    protected $teamCity = [
        'Boston Celtics' => 'Boston',
        'Brooklyn Nets' => 'Brooklyn',
        'New York Knicks' => 'New York',
        'Philadelphia 76ers' => 'Philadelphia',
        'Toronto Raptors' => 'Toronto',
        'Golden State Warriors' => 'San Francisco',
        'Los Angeles Clippers' => 'Los Angeles',
        'Los Angeles Lakers' => 'Los Angeles',
        'Phoenix Suns' => 'Phoenix',
        'Sacramento Kings' => 'Sacramento',
        'Chicago Bulls' => 'Chicago',
        'Cleveland Cavaliers' => 'Cleveland',
        'Detroit Pistons' => 'Detroit',
        'Indiana Pacers' => 'Indiana',
        'Milwaukee Bucks' => 'Milwaukee',
        'Dallas Mavericks' => 'Dallas',
        'Houston Rockets' => 'Houston',
        'Memphis Grizzlies' => 'Memphis',
        'New Orleans Hornets' => 'New Orleans',
        'San Antonio Spurs' => 'San Antonio',
        'Atlanta Hawks' => 'Atlanta',
        'Charlotte Bobcats' => 'Charlotte',
        'Miami Heat' => 'Miami',
        'Orlando Magic' => 'Orlando',
        'Washington Wizards' => 'Washington',
        'Denver Nuggets' => 'Denver',
        'Minnesota Timberwolves' => 'Minnesota',
        'Oklahoma City Thunder' => 'Oklahoma',
        'Portland Trail Blazers' => 'Portland',
        'Utah Jazz' => 'Utah'
    ];

    /**
     * @throws Exception
     */
    public function getEvents(int $amount = 10): array
    {
        $events = [];

        for ($i = 1; $i <= $amount; $i++) {
            $event = $this->getMockEvent($i);
            $events[] = $event;
        }

        return $events;
    }


    /**
     * Will create a mock basketball game event between two teams
     * @throws Exception
     */
    private function getMockEvent(int $index): array
    {
        $winOdds = random_int(33, 60);
        $team1 = $this->pickRandomTeam();
        $team2 = $this->pickRandomTeam();
        $location = $this->teamCity[$team1];

        if ($winOdds < 50) {
            $location = $this->teamCity[$team2];
        }

        return [
            'uuid' => Uuid::uuid4()->toString(),
            'date_of_event' => time(),
            'name' => 'NBA game',
            'location' => $location,
            'teams' => [
                [
                    'name' => $team1,
                    'odds' => $winOdds
                ],
                [
                    'name' => $team2,
                    'odds' => 100 - $winOdds
                ],
            ],
        ];
    }

    /**
     * @throws Exception
     */
    private function pickRandomTeam(): string {
        return $this->nbaTeams[random_int(0, count($this->nbaTeams) - 1)];
    }
}
