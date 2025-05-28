import { Button, ParagraphContent } from "@/components";
import Container from "@/components/Container";
import Heading from "@/components/Heading";
import { staticContext } from "@/utils/contexts";
import { Link } from "@inertiajs/react";
import { useContext, useEffect, useRef, useState } from "react";
import ApartmentIcon from "../assets/apartment-icon.svg";
import CTAApartmentIcon from "../assets/cta-apartment-icon.svg";
import HouseIcon from "../assets/house-icon.svg";
import IndustrialIcon from "../assets/industrial-icon.svg";
import MoneyIcon from "../assets/money-icon.svg";
import PlantHouseIcon from "../assets/plant-house-icon.svg";
import RiyalIcon from "../assets/riyal.svg";
import CTASection from "./CTASection";

type Price = {
    title: string;
    description: string;
    price: number;
    icon: string;
};

const PricesSection = () => {
    const static_content = useContext<Record<string, string>>(staticContext);
    const prices: Price[] = [
        {
            title: "التسعير 1",
            description: "تقييم عقار سكن مساحة اقل عن 1000متر مربع",
            price: 1450,
            icon: HouseIcon,
        },
        {
            title: "التسعير 2",
            description: "تقييم عقاري تجاري",
            price: 2800,
            icon: ApartmentIcon,
        },
        {
            title: "التسعير 3",
            description: "تقييم عقارات زراعية اقل من 50,0000 متر مربع",
            price: 6000,
            icon: PlantHouseIcon,
        },
        {
            title: "التسعير 4",
            description: "تقييم عقارات زراعية اكبر من 50,0000 متر مربع",
            price: 7000,
            icon: IndustrialIcon,
        },
    ];

    return (
        <section className="relative mb-16">
            <Container>
                <div className="flex flex-col items-center mb-16">
                    <div className="flex gap-4">
                        <img
                            src={MoneyIcon}
                            alt="Money Icon"
                            className="w-16 h-16"
                        />
                        <div className="flex flex-col">
                            <Heading
                                title={static_content["packages_title"]}
                                size={3}
                            />
                            <ParagraphContent className="max-w-[480px]">
                                <div
                                    dangerouslySetInnerHTML={{
                                        __html: static_content[
                                            "packages_description"
                                        ],
                                    }}
                                />
                            </ParagraphContent>
                        </div>
                    </div>
                </div>
                <div className="flex flex-col md:flex-row flex-wrap gap-16 md:gap-x-8 md:gap-y-12 lg:gap-6 justify-center">
                    {prices.map((price) => (
                        <div
                            key={price.title}
                            className="flex flex-col flex-grow items-center border-[3px] h-full border-primary-600 pt-10 px-4 relative rounded-br-lg rounded-tl-lg"
                        >
                            <div className="flex items-center justify-center bg-white p-2 rounded-full absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 overflow-hidden w-24 h-24">
                                <img
                                    src={price.icon}
                                    alt={price.title}
                                    className="w-20 h-20 absolute bg-white -translate-y-1 rounded-full"
                                />
                                <div className="w-full h-full bg-primary-600 rounded-full" />
                            </div>
                            <div className="flex flex-col items-center">
                                <div className="flex items-center gap-2">
                                    <img src={RiyalIcon} alt="Riyal Icon" />
                                    <h2 className="text-primary-600 head-line-h2 font-bold">
                                        {price.price}
                                    </h2>
                                </div>
                                <ParagraphContent
                                    textDirection="text-center"
                                    className="max-w-[480px] mb-4"
                                >
                                    {price.description}
                                </ParagraphContent>
                                <Link href="/request-evaluation">
                                    <Button className="mb-4">
                                        اطلب الخدمة الآن
                                    </Button>
                                </Link>
                            </div>
                        </div>
                    ))}
                </div>
            </Container>
            <img
                src={MoneyIcon}
                alt="Money Icon"
                className="absolute top-0 hidden md:block left-16 w-24 h-24 lg:w-32 lg:h-32 opacity-30"
            />
        </section>
    );
};

export default PricesSection;
