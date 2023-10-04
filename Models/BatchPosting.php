<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Accounting\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Accounting\Models;

/**
 * BatchPosting class.
 *
 * @package Modules\Accounting\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class BatchPosting implements \Countable
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    /**
     * Creator.
     *
     * @var int
     * @since 1.0.0
     */
    public int $creator = 0;

    /**
     * Created.
     *
     * @var \DateTimeImmutable
     * @since 1.0.0
     */
    public \DateTimeImmutable $created;

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    public string $description = '';

    /**
     * Postings.
     *
     * @var PostingInterface[]
     * @since 1.0.0
     */
    public $postings = [];

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->created = new \DateTimeImmutable('now');
    }

    /**
     * Get id.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get posting.
     *
     * @param int $id Posting ID
     *
     * @return null|PostingInterface
     *
     * @since 1.0.0
     */
    public function getPosting(int $id) : ?PostingInterface
    {
        return $this->postings[$id] ?? null;
    }

    /**
     * Remove posting.
     *
     * @param int $id Posting ID
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removePosting($id) : bool
    {
        if (!isset($this->postings[$id])) {
            return false;
        }

        unset($this->postings[$id]);

        return true;
    }

    /**
     * Add posting.
     *
     * @param PostingInterface $posting Posting
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addPosting(PostingInterface $posting) : void
    {
        $this->postings[] = $posting;
    }

    /**
     * {@inheritdoc}
     */
    public function count() : int
    {
        return \count($this->postings);
    }
}
