import React, { forwardRef } from "react";

interface Props {
    name: string;
    label: string;
    placeholder: string;
    error?: string;
}

const TextArea = forwardRef<HTMLTextAreaElement, Props>(
    ({ name, label, placeholder, error }, ref) => {
        return (
            <section className="flex flex-col items-start gap-[20px] self-stretch">
                <div className="flex flex-col items-start gap-[16px] self-stretch group">
                    <label
                        htmlFor={name}
                        className="regular-b1 text-right text-Gray-scale-02 group-focus-within:text-primary-600 transition-colors duration-300"
                    >
                        {label}
                    </label>
                    <div className="w-full">
                        <textarea
                            ref={ref}
                            id={name}
                            placeholder={placeholder}
                            className={`resize-none w-[526px] text-right max-w-full h-[150px] flex justify-end items-center py-[13px] px-[16px] gap-[10px] bg-bg-02 border-[1px] ${
                                error
                                    ? "border-red-500 hover:border-red-600 focus:border-red-700"
                                    : "border-transparent hover:border-primary-400 focus:border-primary-600"
                            } hover:bg-bg-01 focus:bg-bg-01 outline-none transition-all duration-300`}
                        />
                        {error && (
                            <p className="mt-1 text-right text-red-500 text-sm">
                                {error}
                            </p>
                        )}
                    </div>
                </div>
            </section>
        );
    }
);

TextArea.displayName = "TextArea";

export default TextArea;
