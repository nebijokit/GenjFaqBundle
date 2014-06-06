<?php

namespace Genj\FaqBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Genj\FaqBundle\Entity\Question;

/**
 * Class LoadQuestionData
 *
 * @package Genj\FaqBundle\DataFixtures\ORM
 */
class LoadQuestionData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $data = array(
            'category-subscription' => array(
                'How can I get a subscription?',
                'When will my subscription renew?',
                'When will I receive the bill for my subscription?',
                'How do I cancel my subscription?',
                'This question exists in both categories'
            ),
            'category-website' => array(
                'I lost my password',
                'I cannot log in to the website',
                'I have a cool idea for the website',
                'This question exists in both categories',
                'This question exists in both categories'
            )
        );

        $rank = 0;
        foreach ($data as $category => $questions) {
            foreach ($questions as $questionText) {
                $question = new Question();
                $question->setHeadline($questionText);
                $question->setBody('The answer to the question "' . $questionText . '".');
                $question->setRank($rank);
                $question->setCategory($this->getReference($category));

                $manager->persist($question);
                $manager->flush();

                $rank++;
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
