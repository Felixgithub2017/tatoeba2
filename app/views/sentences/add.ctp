<?php
/**
 * Tatoeba Project, free collaborative creation of multilingual corpuses project
 * Copyright (C) 2009  HO Ngoc Phuong Trang <tranglich@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Tatoeba
 * @author   HO Ngoc Phuong Trang <tranglich@gmail.com>
 * @license  Affero General Public License
 * @link     http://tatoeba.org
 */

$this->pageTitle = 'Tatoeba - ' . __('Add sentences', true);
?>

<div id="annexe_content">
    <?php
    $attentionPlease->tatoebaNeedsYou();
    ?>
</div>

<div id="main_content">
    
    <div class="module">
        <h2><?php __('Add another sentence'); ?></h2>
        <div class="sentences_set">
            <div class="new">
            <?php
            echo $form->input(
                'text', 
                array(
                    "label" => __('Sentence : ', true),
                    "id" => "SentenceText"
                )
            );
            $langArray = $languages->translationsArray();
            $preSelectedLang = $session->read('contribute_lang');

            if (empty($preSelectedLang)) {
                $preSelectedLang = 'auto';
            }
            ?>
            
            <div class="languageSelection">
            <?php
            echo $form->select(
                'contributionLang',
                $langArray,
                $preSelectedLang,
                array("class"=>"translationLang"),
                false
            );
            ?>
            </div>
            
            <?php
            echo $form->button('OK', array("id" => "submitNewSentence"));
            ?>
            </div>
        </div>
    </div>
    
    <div class="module">
        <h2><?php __('Sentences added'); ?></h2>
        
        <div class="sentencesAddedloading" style="display:none">
        <?php echo $html->image('loading.gif'); ?>
        </div>
        
        <div id="sentencesAdded">
        <?php
        if (isset($sentence)) {
            $translation = array();            
            $sentences->displaySentencesGroup(
                $sentence['Sentence'],
                $translation,
                $sentence['User']
            );
        }
        ?>
        </div>
    </div>
</div>