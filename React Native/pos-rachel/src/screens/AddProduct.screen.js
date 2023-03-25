import React, { Fragment, useState, useEffect } from "react"
import { Text, TouchableHighlight, View, SafeAreaView, TextInput, ScrollView, Dimensions, Image } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { ArrowLeftIcon, ChevronRightIcon, QrcodeIcon } from "react-native-heroicons/solid"
import { CameraIcon, TrashIcon } from "react-native-heroicons/outline"
import ToggleSwitch from "toggle-switch-react-native"
import ButtonSecondary from "../components/molecules/ButtonSecondary.molecule"
import ButtonPrimary from "../components/molecules/ButtonPrimary.molecule"

const AddProduct = ({ navigation }) => {
    const [height, setHeight] = useState(0)
    const [favorite, setFavorite] = useState(false)
    const [barcode, setBarcode] = useState(false)

    useEffect(() => {
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })
    }, [])

    return (
        <Fragment>
            <SafeAreaView>
                <View style={ [Tailwind`w-full flex flex-col bg-primary--red--20 px-6 pb-6`, { height }] }>
                    <ScrollView>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-6` }>
                            <View style={ Tailwind`flex flex-row items-center` }>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-full` } onPress={ () => navigation.goBack() }>
                                    <ArrowLeftIcon size={ 22 } style={ Tailwind`text-accent--black opacity-50` }/>
                                </TouchableHighlight>
                                <Text style={ Tailwind`font-rubik-semibold text-primary--red ml-4 text-base` }>
                                    Tambah Produk
                                </Text>
                            </View>
                            <Image
                                source={ { uri: "https://images.unsplash.com/photo-1593085512500-5d55148d6f0d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y2FydG9vbnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60" } }
                                resizeMode={ "contain" }
                                style={ Tailwind`w-11 h-11 rounded-full ml-5` }
                            />
                        </View>
                        <View style={ Tailwind`w-full flex flex-col bg-white mt-6 rounded-2xl` }>
                            <View style={ Tailwind`w-full p-6` }>
                                <View style={ Tailwind`w-24 h-24 rounded-md border-2 border-gray-300 bg-gray-200 self-center flex flex-col items-center justify-center` }>
                                    <Text style={ Tailwind`text-accent--black text-3xl` }>
                                        NP
                                    </Text>
                                </View>
                                <View style={ [Tailwind`w-10 h-10 rounded-full bg-primary--red flex flex-col items-center justify-center shadow-lg self-center z-50`, { transform: [{ translateY: -30 }, { translateX: 40 }] }] }>
                                    <CameraIcon size={ 22 } style={ Tailwind`text-white` }/>
                                </View>
                                <TextInput
                                    placeholder="Nama Produk"
                                    style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-5` }
                                />
                                <TextInput
                                    placeholder="Harga Jual"
                                    style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3` }
                                />
                                <TextInput
                                    placeholder="Pilih Merek"
                                    style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3` }
                                />
                                <TextInput
                                    placeholder="Pilih Kategori"
                                    style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3` }
                                />
                            </View>
                        </View>
                        <View style={ Tailwind`w-full p-6 mt-3 bg-white flex flex-row items-center justify-between rounded-2xl` }>
                            <View style={ Tailwind`flex flex-col` }>
                                <Text style={ Tailwind`font-bold text-accent--black text-base` }>
                                    Produk Favorit
                                </Text>
                                <Text style={ Tailwind`text-xs text-accent--black opacity-80 mt-1` }>Tampilkan produk di kategori terdepan.</Text>
                            </View>
                            <ToggleSwitch
                                isOn={ favorite }
                                onColor={ "red" }
                                offColor={ "gray" }
                                size={ "medium" }
                                onToggle={ (isOn) => setFavorite((value) => !value) }
                            />
                        </View>
                        <View style={ Tailwind`w-full p-6 mt-3 bg-white flex flex-col rounded-2xl` }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                <Text style={ Tailwind`font-bold text-accent--black text-base` }>
                                    Atur Harga Modal dan Barcode
                                </Text>
                                <ToggleSwitch
                                    isOn={ barcode }
                                    onColor={ "red" }
                                    offColor={ "gray" }
                                    size={ "medium" }
                                    onToggle={ (isOn) => setBarcode((value) => !value) }
                                />
                            </View>
                            {
                                barcode ? 
                                    <View style={ Tailwind`mt-5` }>
                                        <TextInput
                                            placeholder="Pilih Kategori"
                                            style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3` }
                                        />
                                        <View style={ Tailwind`w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3 flex flex-row items-center justify-between` }>
                                            <TextInput
                                                placeholder="Kode Produk / Barcode"
                                                style={ Tailwind`text-sm text-accent--black tracking-wide p-0 flex-grow` }
                                            />
                                            <QrcodeIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                                        </View>
                                    </View> : null
                            }
                        </View>
                        <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("AddStock") }>
                            <View style={ Tailwind`w-full p-6 mt-3 bg-white flex flex-row items-center justify-between rounded-2xl` }>
                                <Text style={ Tailwind`font-bold text-accent--black text-base` }>
                                    Kelola Stok
                                </Text>
                                <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                            </View>
                        </TouchableHighlight>
                        <View style={ Tailwind`w-full p-6 mt-3 bg-white flex flex-col rounded-2xl` }>
                            <View style={ Tailwind`flex flex-row items-center justify-between mb-5 rounded-lg` }>
                                <View style={ Tailwind`flex flex-col` }>
                                    <Text style={ Tailwind`font-bold text-accent--black text-base` }>
                                        Atur Harga Grosir
                                    </Text>
                                    <Text style={ Tailwind`text-xs text-accent--black opacity-80 mt-1` }>Kamu akan lebih leluasa mengatur harga grosir sesuai keinginanmu.</Text>
                                </View>
                                <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                            </View>
                            <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-lg mt-5` }>
                                <ButtonSecondary text={ "Tambah Varian" }/>
                            </TouchableHighlight>
                            <View style={ Tailwind`w-full flex flex-col items-center p-6 bg-gray-100 rounded-lg mt-5` }>
                                <View style={ Tailwind`flex flex-row items-center` }>
                                    <TrashIcon size={ 22 } style={ Tailwind`text-accent--black opacity-70` }/>
                                    <Text style={ Tailwind`text-accent--black text-sm ml-3` }>
                                        Hapus Produk
                                    </Text>
                                </View>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`mt-5 w-full rounded-lg` }>
                                    <ButtonPrimary text={ "Simpan" }/>
                                </TouchableHighlight>
                            </View>
                        </View>
                    </ScrollView>
                </View>
            </SafeAreaView>
        </Fragment>
    )
}

export default AddProduct