<?php

namespace Genj\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Entity\MappedSuperclass\AbstractPersonalTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="genj_faq_question_translations",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="content_unique_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 */
class QuestionTranslation extends AbstractPersonalTranslation
{
    /**
     * @ORM\ManyToOne(targetEntity="Genj\FaqBundle\Entity\Question", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;
}