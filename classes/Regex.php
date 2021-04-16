<?php
/**
 * Regex
 *
 * This file is part of the Framie Framework.
 *
 * @link		$HeadURL$
 * @version     $Id$
 *
 * The Framie WAF/CMS is a modern web application framework and content
 * management system  written for  PHP 7.1 or  higher.  It is implemented
 * fully object-oriented and  takes advantage of the latest web standards
 * such as HTML5 and CSS3.  Thanks to the modular design  and the variety
 * of features,  the system can quickly be adapted to given requirements.
 *
 *               Copyright (c) 2019 - 2020 gullDesign
 *                         All rights reserved.
 *
 * THIS SOFTWARE IS PROVIDED  BY THE  COPYRIGHT HOLDERS  AND CONTRIBUTORS
 * "AS IS"  AND ANY  EXPRESS OR  IMPLIED  WARRANTIES,  INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED  WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE  ARE DISCLAIMED.  IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR  CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL,  EXEMPLARY,  OR  CONSEQUENTIAL  DAMAGES  (INCLUDING,  BUT NOT
 * LIMITED TO,  PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION)  HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY,  WHETHER IN CONTRACT,  STRICT LIABILITY,  OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE)  ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE,  EVEN IF ADVISED OF  THE POSSIBILITY OF SUCH DAMAGE.
 *
 *
 * @license		http://gulldesign.ch/license.txt
 * @copyright	Copyright (c) 2019 - 2020 gullDesign
 * @link		https://bitbucket.org/gulldesign/framie
 */

/**
 * Regex
 *
 */
class Regex
{
	private $regex = '/[\d]{2}\.?[\d]{3}\.?[\d]{2}/';
	private $matches;
	
	public function __construct()
	{

	}

	public function getMatches()
	{
		return $this->matches[0];
	}

	public function setMatches($matches)
	{
		$this->matches = $matches;
	}

	private function findItems()
	{
		if (isset($_POST['manus'])) {
			preg_match_all($this->regex, $_POST['manus'], $matches);

			$this->setMatches($matches);
		}
	}

	private function showMatches(array $result)
	{
		return implode("<br>", $this->deleteDuplicates($result));		
	}

	private function deleteDuplicates(array $list)
	{
		return array_unique($list);
	}

	public function countMatches()
	{
		return count($this->deleteDuplicates($this->getMatches()));
	}

	private function showFormatted($output)
	{
		echo "<strong> . $output . </strong>";
	}

	public function run()
	{
		$this->findItems();
	}
	
	public function showResult()
	{
		return $this->showMatches($this->getMatches());
		if (null !== ($this->getMatches())) {
		}
	}
}