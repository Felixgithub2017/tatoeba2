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

/**
 * Display all comments on the sentences own by a specific user
 *
 * @category SentenceComments
 * @package  Views
 * @author   HO Ngoc Phuong Trang <tranglich@gmail.com>
 * @license  Affero General Public License
 * @link     http://tatoeba.org
 */

// use to send the same arguments to each pages
$paginator->options(
    array(
        'url' => $this->params['pass']
    ) 
); 

?>

<div id="main_content">
    <div class="module">
        <h2>
            <?php 
            echo $paginator->counter(
                array(
                    'format' => sprintf(
                        __("Comments on %s's sentences (total %s)", true),
                        $userName,
                        '%count%'
                    )
                )
            ); 
            ?>
        </h2>
        
        <div class="paging">
        <?php 
        echo $paginator->prev(
            '<< '.__('previous', true), 
            array(), 
            null, 
            array('class'=>'disabled')
        ); 
        ?>
        <?php echo $paginator->numbers(array('separator' => '')); ?>
        <?php 
        echo $paginator->next(
            __('next', true).' >>',
            array(),
            null, 
            array('class'=>'disabled')
        ); 
        ?>
        </div>
        
        <ol class="comments">
        <?php
        foreach ($userComments as $i=>$comment) {
            $comments->displaySentenceComment(
                $comment,
                true,
                $commentsPermissions[$i]
            );
        }
        ?>
        </ol>
        
        <div class="paging">
            <?php
            echo $paginator->prev(
                '<< '.__('previous', true), 
                array(), 
                null, 
                array('class'=>'disabled')
            ); 
            ?>

            <?php echo $paginator->numbers(array('separator' => '')); ?>
            <?php 
            echo $paginator->next(
                __('next', true).' >>', 
                array(), 
                null, 
                array('class'=>'disabled')
            ); 
            ?>
        </div>
        
    </div>
</div>




