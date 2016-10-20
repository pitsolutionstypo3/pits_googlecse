<?php

namespace PITS\PitsGooglecse\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Anu Bhuvanendran Nair <anu.bn@pitsolutions.com>, PIT Solutions
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \PITS\PitsGooglecse\Domain\Model\Search.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Anu Bhuvanendran Nair <anu.bn@pitsolutions.com>
 */
class SearchTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \PITS\PitsGooglecse\Domain\Model\Search
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \PITS\PitsGooglecse\Domain\Model\Search();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function dummyTestToNotLeaveThisFileEmpty() {
		$this->markTestIncomplete();
	}
}