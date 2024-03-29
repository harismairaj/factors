<?php
/**
 * @var \humhub\modules\space\models\Space $space
 * @var string $content
 */

$space = $this->context->contentContainer;
$nonLogin = empty(Yii::$app->user->identity->username);
if(!empty(Yii::$app->user->identity->username) && !Yii::$app->user->isAdmin())
{
  \humhub\modules\custom\widgets\SubmitGuestComment::widget(['space' => $space]);
}
?>
<div class="container space-layout-container">
    <div class="row">
        <div class="col-md-12">
            <?php echo humhub\modules\space\widgets\Header::widget(['space' => $space]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 layout-nav-container left-panel">
            <?php echo \humhub\modules\custom\widgets\SpaceMenu::widget(['space' => $space]); ?>
            <br>
        </div>

        <?php if (isset($this->context->hideSidebar) && $this->context->hideSidebar) : ?>
            <div class="col-md-10 layout-content-container">
                <?= \humhub\modules\space\widgets\SpaceContent::widget([
                    'contentContainer' => $space,
                    'content' => $content
                ]) ?>
            </div>
        <?php else: ?>
            <div class="col-md-7 layout-content-container">
                <!-- ?= \humhub\modules\topics\widgets\Seo::widget(['space' => $space]); ?-->
                <?php if($nonLogin){ ?>
                <?= \humhub\modules\custom\widgets\GuestPost::widget(['space' => $space]); ?>
                <?php } ?>
                <?= \humhub\modules\space\widgets\SpaceContent::widget([
                    'contentContainer' => $space,
                    'content' => $content
                ]) ?>
            </div>
            <div class="col-md-3 layout-sidebar-container">
                <?php
                echo \humhub\modules\space\widgets\Sidebar::widget(['space' => $space, 'widgets' => [
                        [\humhub\modules\activity\widgets\Stream::className(), ['streamAction' => '/space/space/stream', 'contentContainer' => $space], ['sortOrder' => 10]],
                        [\humhub\modules\space\modules\manage\widgets\PendingApprovals::className(), ['space' => $space], ['sortOrder' => 20]],
                        [\humhub\modules\space\widgets\Members::className(), ['space' => $space], ['sortOrder' => 30]]
                ]]);
                ?>
            </div>
        <?php endif; ?>
    </div>
</div>
