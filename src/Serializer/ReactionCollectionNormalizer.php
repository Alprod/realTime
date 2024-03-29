<?php

namespace App\Serializer;

use App\Repository\ReactionRepository;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;


class ReactionCollectionNormalizer implements ContextAwareNormalizerInterface
{
    private $normalizer;
    private $reactionRepository;

    public function __construct(NormalizerInterface $normalizer, ReactionRepository $reactionRepository)
    {
        $this->normalizer = $normalizer;
        $this->reactionRepository = $reactionRepository;
    }

    public function normalize($object, $format = null, array $context = array()): array
    {
        $data = $this->normalizer->normalize($object, $format, $context);
        $data += $this->reactionRepository->countReactions($context['subresource_identifier']['id']);

        return $data;
    }

    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return
            'api_sessions_reactions_get_subresource' === ($context['subresource_operation_name'] ?? null)
            && false === ($context['api_sub_level'] ?? false)
            && $this->normalizer->supportsNormalization($data, $format, $context);
    }

   
}
