<?php

namespace Lsv\FifaWorldcupParser\Tests\Parser;

use Lsv\FifaWorldcupParser\Model\GroupMatch;
use Lsv\FifaWorldcupParser\Model\Team;
use Lsv\FifaWorldcupParser\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    protected function getParser(string $file = null)
    {
        $data = null;
        if ($file) {
            $data = file_get_contents(__DIR__ . '/../data/' . $file);
        }

        return new Parser($data);
    }

    public function testLiveFile(): void
    {
        $data = $this->getParser()->parse();
        $this->assertCount(8, $data->getGroups()->getGroups());
    }

    public function testGroups(): void
    {
        $data = $this->getParser('notstarted.json')->parse();
        $this->assertCount(8, $data->getGroups()->getGroups());
    }

    public function testWinnerShouldBeATeam(): void
    {
        $data = $this->getParser('groupa_finished.json')->parse();
        $this->assertInstanceOf(Team::class, $data->getGroups()->getGroups()[0]->getWinner());
        $this->assertSame('Russia', $data->getGroups()->getGroups()[0]->getWinner()->getName());
    }

    public function testRunnerupShouldBeATeam(): void
    {
        $data = $this->getParser('groupa_finished.json')->parse();
        $this->assertInstanceOf(Team::class, $data->getGroups()->getGroups()[0]->getWinner());
        $this->assertSame('Saudi Arabia', $data->getGroups()->getGroups()[0]->getRunnerup()->getName());
    }

    public function testGroupMatches(): void
    {
        $data = $this->getParser('notstarted.json')->parse();
        $this->assertCount(6, $data->getGroups()->getGroups()[0]->getMatches());
        $this->assertInstanceOf(GroupMatch::class, $data->getGroups()->getGroups()[0]->getMatches()[0]);
        $this->assertSame($data->getGroups()->getGroups()[0]->getMatches()[0]->getGroup()->getName(), $data->getGroups()->getGroups()[0]->getName());
    }

    public function testKnockoutMatch(): void
    {
        $data = $this->getParser('groupa_finished.json')->parse();
        $this->assertSame('Round of 16', $data->getKnockoutRounds()->getKnockoutRounds()[0]->getName());
        $this->assertSame('round_16', $data->getKnockoutRounds()->getKnockoutRounds()[0]->getId());
        $match = $data->getKnockoutRounds()->getKnockoutRounds()[0]->getMatches()[0];
        $this->assertSame(5, $match->getHomePenalty());
        $this->assertSame(4, $match->getAwayPenalty());
        $this->assertSame('home', $match->getWinner());
        $this->assertSame($data->getKnockoutRounds()->getKnockoutRounds()[0]->getName(), $match->getKnockoutRound()->getName());
    }

    public function testKnockouts(): void
    {
        $data = $this->getParser('notstarted.json')->parse();
        $this->assertCount(5, $data->getKnockoutRounds()->getKnockoutRounds());
    }

    public function testInvalidFile(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/^Setter/');
        $this->getParser('wrongly_json.json')->parse();
    }

    public function testStadiumNotFound(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/^Stadium/');
        $this->getParser('stadium_notfound.json')->parse();
    }

    public function testTvChannelNotFound(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/^TvChannel/');
        $this->getParser('tvchannel_notfound.json')->parse();
    }

    public function testTeamNotFoundNotFound(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/^Team/');
        $this->getParser('team_notfound.json')->parse();
    }

    public function testMatch(): void
    {
        $data = $this->getParser('notstarted.json')->parse();
        $match = $data->getGroups()->getGroups()[0]->getMatches()[0];

        $this->assertSame(1, $match->getName());
        $this->assertSame('group', $match->getType());
        $this->assertInstanceOf(Team::class, $match->getHomeTeam());
        $this->assertSame('Russia', $match->getHomeTeam()->getName());
        $this->assertSame('ru', $match->getHomeTeam()->getIso2());
        $this->assertSame('https://upload.wikimedia.org/wikipedia/en/thumb/f/f3/Flag_of_Russia.svg/900px-Flag_of_Russia.png', $match->getHomeTeam()->getFlag());
        $this->assertSame('🇷🇺', $match->getHomeTeam()->getEmojiString());
        $this->assertSame('RUS', $match->getHomeTeam()->getFifaCode());
        $this->assertSame(':flag-ru: Russia', $match->getSlackName($match->getHomeTeam()));
        $this->assertNull($match->getHomeResult());
        $this->assertInstanceOf(Team::class, $match->getAwayTeam());
        $this->assertSame('Saudi Arabia', $match->getAwayTeam()->getName());
        $this->assertSame('Saudi Arabia', $match->getSlackName($match->getAwayTeam()));
        $this->assertNull($match->getAwayResult());
        $this->assertSame('14-06-2018', $match->getDate()->format('d-m-Y'));
        $this->assertSame('Luzhniki Stadium', $match->getStadium()->getName());
        $this->assertCount(2, $match->getChannels());
        $this->assertFalse($match->isFinished());
        $this->assertSame(1, $match->getMatchday());


        $match = $data->getKnockoutRounds()->getKnockoutRounds()[0]->getMatches()[0];
        $team = $match->getHomeTeam();
        $this->assertSame($team, $match->getSlackName($team));
    }

    public function testStadium(): void
    {
        $data = $this->getParser('notstarted.json')->parse();
        $stadium = $data->getStadiums()[0];

        $this->assertSame(1, $stadium->getId());
        $this->assertSame('Luzhniki Stadium', $stadium->getName());
        $this->assertSame('Moscow', $stadium->getCity());
        $this->assertSame(55.715765, $stadium->getLat());
        $this->assertSame(37.5515217, $stadium->getLng());
    }

    public function testTvChannel(): void
    {
        $data = $this->getParser('notstarted.json')->parse();
        $channels = $data->getTvchannels();
        $this->assertCount(7, $channels);
        $channel = $channels[6];

        $this->assertSame(7, $channel->getId());
        $this->assertSame('Telecinco', $channel->getName());
        $this->assertSame('https://upload.wikimedia.org/wikipedia/commons/7/75/Telecinco_2012.png', $channel->getIcon());
        $this->assertSame('Spain', $channel->getCountry());
        $this->assertSame('es', $channel->getIso2());
        $this->assertCount(1, $channel->getLang());
    }
}
