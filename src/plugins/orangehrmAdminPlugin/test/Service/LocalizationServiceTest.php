<?php
/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 */

namespace OrangeHRM\Tests\Admin\Service;

use DateTime;
use Exception;
use OrangeHRM\Admin\Dao\LocalizationDao;
use OrangeHRM\Admin\Dto\I18NLanguageSearchFilterParams;
use OrangeHRM\Admin\Service\LocalizationService;
use OrangeHRM\Core\Service\DateTimeHelperService;
use OrangeHRM\Core\Service\NormalizerService;
use OrangeHRM\Entity\I18NLanguage;
use OrangeHRM\Framework\Services;
use OrangeHRM\Tests\Util\KernelTestCase;

/**
 * @group Admin
 * @group Service
 */
class LocalizationServiceTest extends KernelTestCase
{
    private LocalizationService $localizationService;

    /**
     * Set up method
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->localizationService = new LocalizationService();
    }

    public function testGetLocalizationDateFormats(): void
    {
        $dateTimeHelper = $this->getMockBuilder(DateTimeHelperService::class)
            ->onlyMethods(['getNow'])
            ->getMock();
        $dateTimeHelper->expects($this->atLeastOnce())
            ->method('getNow')
            ->willReturnCallback(fn () => new DateTime('2022-06-05'));

        $this->createKernelWithMockServices([Services::DATETIME_HELPER_SERVICE => $dateTimeHelper]);
        $formats = $this->localizationService->getLocalizationDateFormats();
        $this->assertCount(11, $formats);
        $this->assertEquals('Y-m-d', $formats[0]['id']);
        $this->assertEquals('yyyy-mm-dd ( 2022-06-05 )', $formats[0]['label']);
        $this->assertEquals('l, d-M-Y', $formats[9]['id']);
        $this->assertEquals('DD, dd-M-yyyy ( Sunday, 05-Jun-2022 )', $formats[9]['label']);
        $this->assertEquals('D, d M Y', $formats[10]['id']);
        $this->assertEquals('D, dd M yyyy ( Sun, 05 Jun 2022 )', $formats[10]['label']);
    }

    public function testGetSupportedLanguages(): void
    {
        $expectedResult = ['A', 5, '%'];
        $this->localizationService = $this->getMockBuilder(LocalizationService::class)
            ->onlyMethods(['getLanguagesArray'])
            ->getMock();
        $this->localizationService->expects($this->once())
            ->method('getLanguagesArray')
            ->will($this->returnValue($expectedResult));
        $this->assertEquals($expectedResult, $this->localizationService->getSupportedLanguages());
    }

    public function testSearchLanguages(): void
    {
        $expectedArray = ['A', 5, '%'];
        $i18nLanguageFilterParams = new I18NLanguageSearchFilterParams();
        $localizationDao = $this->getMockBuilder(LocalizationDao::class)->getMock();
        $localizationDao->expects($this->once())
            ->method('searchLanguages')
            ->with($i18nLanguageFilterParams)
            ->will($this->returnValue($expectedArray));
        $localizationService = $this->getMockBuilder(LocalizationService::class)
            ->onlyMethods(['getLocalizationDao'])
            ->getMock();
        $localizationService->expects($this->once())
            ->method('getLocalizationDao')
            ->willReturn($localizationDao);
        $result = $localizationService->searchLanguages($i18nLanguageFilterParams);
        $this->assertEquals($expectedArray, $result);
    }

    public function testGetCountryArray(): void
    {
        $language = new I18NLanguage();
        $language->setName('Valerian');
        $language->setCode('VLR');

        $localizationService = $this->getMockBuilder(LocalizationService::class)
            ->onlyMethods(['getNormalizerService', 'searchLanguages'])
            ->getMock();

        $i18nLanguageFilterParams = new I18NLanguageSearchFilterParams();
        $localizationService->expects($this->once())
            ->method('searchLanguages')
            ->with($i18nLanguageFilterParams)
            ->will($this->returnValue([$language]));
        $localizationService->expects($this->once())
            ->method('getNormalizerService')
            ->will($this->returnValue(new NormalizerService()));

        $languages = $localizationService->getLanguagesArray($i18nLanguageFilterParams);
        $this->assertCount(1, $languages);
        $this->assertEquals('Valerian', $languages[0]['label']);
        $this->assertEquals('VLR', $languages[0]['id']);
    }

    public function testGenerateLangStringLanguageKey(): void
    {
        $this->assertEquals('1_2_', $this->localizationService->generateLangStringLanguageKey(1, 2));
    }
}
