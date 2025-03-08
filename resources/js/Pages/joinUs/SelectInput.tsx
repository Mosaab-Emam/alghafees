// DropdownComponent.js
import React, { forwardRef } from "react";

interface Props {
    name: string;
    label: string;
    error?: string;
}

const SelectInput = forwardRef<HTMLSelectElement, Props>(
    ({ name, label, error }, ref) => {
        return (
            <div className="flex flex-col items-start gap-[16px] self-stretch group">
                <label
                    htmlFor={name}
                    className="regular-b1 text-right text-Gray-scale-02 group-focus-within:text-primary-600 transition-colors duration-300"
                >
                    {label}
                </label>
                <div className="w-full relative">
                    <select
                        ref={ref}
                        id={name}
                        name={name}
                        className={`w-[526px] text-right max-w-full appearance-none sm:h-[48px] lg:h-[46px] xl:h-[48px] flex justify-end items-center py-[13px] px-[16px] gap-[10px] bg-bg-02 border-[1px] ${
                            error
                                ? "border-red-500 hover:border-red-600 focus:border-red-700"
                                : "border-transparent hover:border-primary-400 focus:border-primary-600"
                        } hover:bg-bg-01 focus:bg-bg-01 outline-none transition-all duration-300`}
                    >
                        <option value="متدرب">متدرب</option>
                        <option value="موظف">موظف</option>
                    </select>
                    <svg
                        className="absolute left-4 top-1/2 transform -translate-y-1/2 pointer-events-none"
                        xmlns="http://www.w3.org/2000/svg"
                        width="12"
                        height="8"
                        viewBox="0 0 12 8"
                        fill="none"
                    >
                        <path
                            d="M11 1L6 6L1 1"
                            stroke="#0F819F"
                            strokeWidth="2"
                            strokeLinecap="round"
                        />
                    </svg>
                    {error && (
                        <p className="mt-1 text-right text-red-500 text-sm">
                            {error}
                        </p>
                    )}
                </div>
            </div>
        );
    }
);

SelectInput.displayName = "SelectInput";

export default SelectInput;
