<?php

// src/Scheduler/SaleTaskProvider.php
namespace App\Scheduler;

use App\Scheduler\Message\SendDailySalesReports;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\RecurringMessage;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;

#[AsSchedule]
class SaleTaskProvider implements ScheduleProviderInterface
{
	public function getSchedule(): Schedule
	{
		return (new Schedule())
		->add(
			RecurringMessage::every('10 seconds', new SendDailySalesReports(1))
		)
		;
	}
}