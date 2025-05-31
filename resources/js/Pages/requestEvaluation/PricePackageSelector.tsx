import ApartmentIcon from "../Pricing/assets/apartment-icon.svg";
import HouseIcon from "../Pricing/assets/house-icon.svg";
import IndustrialIcon from "../Pricing/assets/industrial-icon.svg";
import PlantHouseIcon from "../Pricing/assets/plant-house-icon.svg";

import { usePage } from "@inertiajs/react";
import { useEffect, useState } from "react";
import RiyalIcon from "../Pricing/assets/riyal.svg";

type PricePackageSelectorProps = {
    emitSelectedPricePackage: (price_package: number) => void;
};
const PricePackageSelector = ({
    emitSelectedPricePackage,
}: PricePackageSelectorProps) => {
    const price_packages = usePage().props.price_packages as Array<{
        id: number;
        title: string;
        description: string;
        price: number;
        icon: string;
        perks: Array<{ title: string }>;
    }>;

    const initial_price_package = (() => {
        try {
            const params = usePage().url.split("?")[1];
            if (!params) throw new Error();
            const price_package = params.split("=");
            if (price_package[0] !== "price_package_id") throw new Error();
            return parseInt(price_package[1]);
        } catch {
            return price_packages[0].id;
        }
    })();

    const [selectedPricePackage, setSelectedPricePackage] = useState<number>(
        initial_price_package
    );

    useEffect(() => {
        emitSelectedPricePackage(selectedPricePackage);
    }, [selectedPricePackage]);

    return (
        <div className="grid grid-cols-1 md:grid-cols-4 gap-x-6 gap-y-16">
            {price_packages.map((price_package) => (
                <div
                    key={price_package.id}
                    className={`cursor-pointer transition-all duration-300 flex flex-col border-[3px] pt-10 px-4 pb-6 relative rounded-br-lg rounded-tl-lg ${
                        selectedPricePackage === price_package.id
                            ? "border-primary-600 bg-primary-50 shadow-lg transform scale-105"
                            : "border-gray-300 hover:border-primary-400 hover:shadow-md"
                    }`}
                    onClick={() => {
                        setSelectedPricePackage(price_package.id);
                    }}
                >
                    <div className="flex items-center justify-center bg-white p-2 rounded-full absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 overflow-hidden w-24 h-24">
                        <img
                            src={price_package.icon}
                            alt={price_package.title}
                            className="w-20 h-20 absolute bg-white -translate-y-1 rounded-full"
                        />
                        <div
                            className={`w-full h-full rounded-full ${
                                selectedPricePackage === price_package.id
                                    ? "bg-primary-600"
                                    : "bg-gray-400"
                            }`}
                        />
                    </div>

                    <div className="flex flex-col items-center text-center">
                        <h4
                            className={`head-line-h4 mt-4 mb-2 ${
                                selectedPricePackage === price_package.id
                                    ? "text-primary-600"
                                    : "text-gray-800"
                            }`}
                        >
                            {price_package.title}
                        </h4>

                        <p className="text-sm text-gray-600 mb-4">
                            {price_package.description}
                        </p>

                        <div className="flex items-center gap-2">
                            <img src={RiyalIcon} alt="Riyal Icon" />
                            <h3
                                className={`head-line-h3 ${
                                    selectedPricePackage === price_package.id
                                        ? "text-primary-600"
                                        : "text-gray-700"
                                }`}
                            >
                                {price_package.price}
                            </h3>
                        </div>

                        <div className="w-full">
                            <ul className="text-base text-gray-700 divide-y divide-gray-200">
                                {price_package.perks.map((perk, perkIndex) => (
                                    <li
                                        key={perkIndex}
                                        className="flex items-center gap-3 w-full py-3 font-medium"
                                    >
                                        <span className="text-lg text-primary-600">
                                            ✓
                                        </span>
                                        <span className="text-base">
                                            {perk.title}
                                        </span>
                                    </li>
                                ))}
                            </ul>
                        </div>
                    </div>
                </div>
            ))}
        </div>
    );
};

export default PricePackageSelector;
