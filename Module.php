<?php
/*
** initMAX
** Copyright (C) 2021-2022 initMAX s.r.o.
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 3 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
**/

namespace Modules\MyModule;

use APP;
use CController as CAction;
use CMenuItem;
use Core\CModule as ModuleBase;

class Module extends ModuleBase
{
    /**
     * Initialize module.
     */
	public function init(): void
	{
          $this->setCompatibilityMode(ZABBIX_VERSION);

          $menuItem = new CMenuItem(_('My Module'));
          $menuItem->setAction('dashboard.view');

          APP::Component()->get('menu.main')
               ->findOrAdd(_('Monitoring'))
                    ->getSubmenu()
                         ->insertBefore(_('Dashboard'), $menuItem);
	}

	/**
     * Event handler, triggered before executing the action.
     *
     * @param CAction $action Action instance responsible for current request.
     */
	public function onBeforeAction(CAction $action): void
	{
          return;
	}

	/**
     * Event handler, triggered on application exit.
     *
     * @param CAction $action Action instance responsible for current request.
     */
	public function onTerminate(CAction $action): void
	{
          return;
	}

     /**
      * Setup the compatibility mode for different Zabbix versions.
      *
      * @param mixed $version 
      * @return void 
      */
     protected function setCompatibilityMode($version)
     {
		if(version_compare($version, '6.0.1', '<'))
          {
               if(!function_exists('hasErrorMessages'))
               {
                    // Define function in global scope
                    eval('function hasErrorMessages() { return hasErrorMesssages(); }');
               }
		}
	}
}
