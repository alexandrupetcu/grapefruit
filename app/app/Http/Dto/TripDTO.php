<?php
namespace App\Http\Dto;

class TripDTO
{
    public function __construct(
        private readonly ?string $slug,
        private readonly ?string $title,
        private readonly ?string $description,
        private readonly ?string $startDate,
        private readonly ?string $endDate,
        private readonly ?string $location,
        private readonly ?float $price
    ){}

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    /**
     * @return string|null
     */
    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }
}
