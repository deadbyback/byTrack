<?php

namespace console\controllers;

use common\rules\ReporterRule;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * Устанавливает роли
     * @throws \Exception
     */
    public function actionRole() {
        $auth = Yii::$app->authManager;

        $worker = $auth->createRole('worker');
        //$worker->description('Сотрудник');
        $auth->add($worker);

        $admin = $auth->createRole('admin');
       // $admin->description('Администратор');
        $auth->add($admin);

        $manager = $auth->createRole('manager');
        //$manager->description('Начальник отдела');
        $auth->add($manager);
    }

    /**
     * Устанавливает права (разрешения)
     * @throws \Exception
     */
    public function actionPermission() {
        $auth = Yii::$app->authManager;

        $canAdmin = $auth->createPermission('canAdmin');
        $canAdmin->description = 'Право на вход в админ.часть';
        $auth->add($canAdmin);

        $updateReport = $auth->createPermission('updateReport');
        $updateReport->description = 'Право на редактирование репортов';
        $auth->add($updateReport);

        $rule = new ReporterRule();
        $auth->add($rule);

        $updateOwnReport = $auth->createPermission('updateOwnReport');
        $updateOwnReport->description = 'Право на редактирование своих репортов';
        $updateOwnReport->ruleName = $rule->name;
        $auth->add($updateOwnReport);
    }

    /**
     * Присваивает ролям свои правила (разрешения)
     * @throws \yii\base\Exception
     */
    public function actionChild() {
        $auth = Yii::$app->authManager;

        $admin = $auth->getRole('admin');
        $canAdmin = $auth->getRole('canAdmin');
        $auth->addChild($admin, $canAdmin);

        $updateReport = $auth->getPermission('updateReport');
        $updateOwnReport = $auth->getPermission('updateOwnReport');
        $auth->addChild($updateOwnReport, $updateReport);

        $manager = $auth->getRole('manager');
        $auth->addChild($manager, $updateReport);
        $auth->addChild($admin, $manager);
    }

    /**
     * Присваивание текущему пользователю роли работника
     * @throws \Exception
     */
    public function actionAssign() {
        $auth = Yii::$app->authManager;

        $userRole = $auth->getRole('worker');
        $auth->assign($userRole, Yii::$app->id);
    }

    /**
     * Присваивает пользователю с указанным id роль Администратора (admin)
     * @param $id
     * @throws \Exception
     */
    public function actionAdmin($id) {
        $auth = Yii::$app->authManager;

        $adminRole = $auth->getRole('admin');
        $auth->assign($adminRole, $id);
    }

    /**
     * Присваивает пользователю с указанным id роль Начальника отдела (manager)
     * @param $id
     * @throws \Exception
     */
    public function actionManager($id) {
        $auth = Yii::$app->authManager;

        $managerRole = $auth->getRole('manager');
        $auth->assign($managerRole, $id);
    }

    public function actionRules() {
        $auth = Yii::$app->authManager;

        $rule = new ReporterRule();
        $auth->add($rule);
    }

    public function actionInit() {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $canAdmin = $auth->createPermission('canAdmin');
        $canAdmin->description = 'Право на вход в админ.часть';
        $auth->add($canAdmin);

        $updateReport = $auth->createPermission('updateReport');
        $updateReport->description = 'Право на редактирование репортов';
        $auth->add($updateReport);

        $rule = new ReporterRule();
        $auth->add($rule);

        $updateOwnReport = $auth->createPermission('updateOwnReport');
        $updateOwnReport->description = 'Право на редактирование своих репортов';
        $updateOwnReport->ruleName = $rule->name;
        $auth->add($updateOwnReport);

        $worker = $auth->createRole('worker');
        $worker->description = 'Сотрудник';
        $auth->add($worker);

        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $auth->add($admin);

        $manager = $auth->createRole('manager');
        $manager->description ='Начальник отдела';
        $auth->add($manager);

        $admin = $auth->getRole('admin');
        $canAdmin = $auth->getRole('canAdmin');
        $auth->addChild($admin, $canAdmin);

        $updateReport = $auth->getPermission('updateReport');
        $updateOwnReport = $auth->getPermission('updateOwnReport');
        $auth->addChild($updateOwnReport, $updateReport);

        $manager = $auth->getRole('manager');
        $auth->addChild($manager, $updateReport);
        $auth->addChild($admin, $manager);
    }
}