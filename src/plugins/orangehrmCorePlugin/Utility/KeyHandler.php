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
 * Boston, MA 02110-1301, USA
 */

namespace OrangeHRM\Core\Utility;

use Exception;
use OrangeHRM\Core\Exception\KeyHandlerException;
use Symfony\Component\Filesystem\Filesystem;

class KeyHandler
{
    public const PATH_TO_KEY = __DIR__ . '/../../../../lib/confs/cryptokeys/key.ohrm';

    private static string $key;
    private static bool $keySet = false;

    /**
     * @throws KeyHandlerException
     */
    public static function createKey(): void
    {
        if (self::keyExists()) {
            throw KeyHandlerException::keyAlreadyExists();
        }

        try {
            $cryptKey = '';
            for ($i = 0; $i < 4; $i++) {
                $cryptKey .= md5(random_int(10000000, 99999999));
            }
            $cryptKey = str_shuffle($cryptKey);

            $fs = new Filesystem();
            $fs->dumpFile(self::PATH_TO_KEY, $cryptKey);
            clearstatcache(true);
        } catch (Exception $e) {
            throw KeyHandlerException::failedToCreateKey();
        }
    }

    /**
     * @return string
     * @throws KeyHandlerException
     */
    public static function readKey(): string
    {
        if (!self::keyExists()) {
            throw KeyHandlerException::keyDoesNotExist();
        }

        if (!is_readable(self::getRealPathToKey())) {
            throw KeyHandlerException::keyIsNotReadable();
        }

        if (!self::$keySet) {
            self::$key = trim(file_get_contents(self::getRealPathToKey()));
            self::$keySet = true;
        }

        return self::$key;
    }

    /**
     * @return bool
     */
    public static function keyExists(): bool
    {
        return self::getRealPathToKey() !== null;
    }

    /**
     * @return string|null
     */
    public static function getRealPathToKey(): ?string
    {
        $path = realpath(self::PATH_TO_KEY);
        return $path === false ? null : $path;
    }
}
