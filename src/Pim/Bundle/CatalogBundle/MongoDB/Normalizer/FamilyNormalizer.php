<?php

namespace Pim\Bundle\CatalogBundle\MongoDB\Normalizer;

use Pim\Bundle\CatalogBundle\Model\FamilyInterface;
use Pim\Bundle\TransformBundle\Normalizer\Structured\TranslationNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Family normalizer
 *
 * @author    Nicolas Dupont <nicolas@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class FamilyNormalizer implements NormalizerInterface
{
    /** @var TranslationNormalizer $transNormalizer */
    protected $transNormalizer;

    /**
     * Constructor
     *
     * @param TranslationNormalizer $transNormalizer
     */
    public function __construct(TranslationNormalizer $transNormalizer)
    {
        $this->transNormalizer = $transNormalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $data = ['code' => $object->getCode()] + $this->transNormalizer->normalize($object, $format, $context);
        $data['attributeAsLabel'] = ($object->getAttributeAsLabel()) ? $object->getAttributeAsLabel()->getCode() : null;

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof FamilyInterface && 'mongodb_json' === $format;
    }
}
