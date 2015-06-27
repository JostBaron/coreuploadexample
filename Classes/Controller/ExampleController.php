<?php
namespace JostBaron\Coreuploadexample\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Helmut Hummel
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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

use TYPO3\CMS\Extbase\Property\TypeConverter\FileUploadConverter;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;

/**
 *
 *
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ExampleController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * exampleRepository
	 *
	 * @var \JostBaron\Coreuploadexample\Domain\Repository\ExampleRepository
	 * @inject
	 */
	protected $exampleRepository;

	/**
	 * action hello
	 *
	 * @return string
	 */
	public function helloAction() {
		return 'Hello World!';
	}

	/**
	 * Action list
	 *
	 * @return void
	 */
	public function listAction() {
		$examples = $this->exampleRepository->findAll();
		$this->view->assign('examples', $examples);
	}

	/**
	 * Action show
	 *
	 * @param \JostBaron\Coreuploadexample\Domain\Model\Example $example
	 */
	public function showAction(\JostBaron\Coreuploadexample\Domain\Model\Example $example) {
		$this->view->assign('example', $example);
	}

	/**
	 * Action show
	 *
	 * @param \JostBaron\Coreuploadexample\Domain\Model\Example $example
     * @ignorevalidation $example
	 */
	public function editAction(\JostBaron\Coreuploadexample\Domain\Model\Example $example) {
		$this->view->assign('example', $example);
	}

	/**
	 * Set TypeConverter option for image upload
	 */
	public function initializeUpdateAction() {
		$this->setTypeConverterConfigurationForImageUpload('example');
	}

	/**
	 * Update-action
	 *
	 * @param \JostBaron\Coreuploadexample\Domain\Model\Example $example
	 */
	public function updateAction(\JostBaron\Coreuploadexample\Domain\Model\Example $example) {
		$this->exampleRepository->update($example);
		$this->addFlashMessage('Your new Example was updated.');
	}

	/**
	 * New-action
	 * @param \JostBaron\Coreuploadexample\Domain\Model\Example $newExample
     * @ignorevalidation $newExample
	 */
	public function newAction(\JostBaron\Coreuploadexample\Domain\Model\Example $newExample = NULL) {
		$this->view->assign('newExample', $newExample);
	}

	/**
	 * Set TypeConverter option for image upload
	 */
	public function initializeCreateAction() {
		$this->setTypeConverterConfigurationForImageUpload('newExample');
	}

	/**
	 * action create
	 *
	 * @param \JostBaron\Coreuploadexample\Domain\Model\Example $newExample
	 */
	public function createAction(\JostBaron\Coreuploadexample\Domain\Model\Example $newExample) {
		$this->exampleRepository->add($newExample);
		$this->addFlashMessage('Your new Example was created.');

        $this->view->assign('newExample', $newExample);
	}

	/**
	 * action delete
	 *
	 * @param \JostBaron\Coreuploadexample\Domain\Model\Example $example
	 * @ignoreValidation $example
	 */
	public function deleteAction(\JostBaron\Coreuploadexample\Domain\Model\Example $example) {
		$this->exampleRepository->remove($example);
		$this->addFlashMessage('Your new Example was removed.');
	}

	/**
	 *
	 */
	protected function setTypeConverterConfigurationForImageUpload($argumentName) {
		$uploadConfiguration = array(
			FileUploadConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
			FileUploadConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/content/',
            FileUploadConverter::CONFIGURATION_DELETE_MODE => FileUploadConverter::CONFIGURATION_DELETE_MODE_REFERENCE_AND_FILE,
		);
		/** @var PropertyMappingConfiguration $newExampleConfiguration */
		$newExampleConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();
		$newExampleConfiguration->forProperty('image')
			->setTypeConverterOptions(
				FileUploadConverter::class,
				$uploadConfiguration
			);
        $newExampleConfiguration->forProperty('imageCollection')->allowProperties('0');
		$newExampleConfiguration->forProperty('imageCollection.0')
			->setTypeConverterOptions(
				FileUploadConverter::class,
				$uploadConfiguration
			);
	}

}
