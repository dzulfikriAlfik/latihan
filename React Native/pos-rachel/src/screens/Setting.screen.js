import React, { Fragment, useState, useEffect } from "react"
import { Text, View, Dimensions, ScrollView, TouchableHighlight, Image, TextInput, SafeAreaView } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { MenuIcon, SearchIcon, ChevronRightIcon } from "react-native-heroicons/solid"
import { CogIcon } from "react-native-heroicons/outline"
import { connect } from "react-redux"
import Drawer from "../components/organisms/Drawer.organism"
import ButtonPrimary from "../components/molecules/ButtonPrimary.molecule"
import ToggleSwitch from "toggle-switch-react-native"
import ButtonSecondary from "../components/molecules/ButtonSecondary.molecule"
import AsyncStorage from "@react-native-async-storage/async-storage"
import RNRestart from "react-native-restart"

const Setting = ({ changeDrawerStatus, navigation, changeUser, changeCart, changeTransactions, changeProducts, changeCategories }) => {
    const [height, setHeight] = useState(0)
    const [widthScreen, setWidthScreen] = useState(0)
    const [variant, setVariant] = useState(false)
    const [isShow, setIsShow] = useState(false)

    const handleResponsive = (actions) => {
        if (widthScreen > 0 && widthScreen <= 1000) {
            return actions[0]
        } else if(widthScreen > 1000) {
            return actions[1]
        } else {
            return actions[0]
        }
    }

    const handleLogout = async () => {
        try {
            await AsyncStorage.multiRemove(["user", "token", "employe"])

            setIsShow(false)
            changeUser({})

            RNRestart.Restart()
        } catch (error) {
            setIsShow(false)
        }
    }

    useEffect(() => {
        changeDrawerStatus(false)
        setWidthScreen(() => Dimensions.get("screen").width)

        Dimensions.addEventListener("change", () => {
            setWidthScreen(() => Dimensions.get("screen").width)
        })
    }, [])

    useEffect(() => {
        changeDrawerStatus(false)
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })
    }, [])

    return (
        <Fragment>
            <SafeAreaView>
                <Drawer/>
                <View style={ [Tailwind`w-full flex flex-col bg-primary--red--20 px-6`, { height }] }>
                    <ScrollView showsVerticalScrollIndicator={ false }>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-6` }>
                            <View style={ Tailwind`flex flex-row items-center` }>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-md` } onPress={ () => changeDrawerStatus(true) }>
                                    <MenuIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                                </TouchableHighlight>
                                <Text style={ Tailwind`font-rubik-semibold text-primary--red ml-4 text-base` }>
                                    Pengaturan
                                </Text>
                            </View>
                            <View style={ Tailwind`flex flex-row items-center` }>
                                {/* <View style={ Tailwind`${ handleResponsive(["w-40 ml-6","w-80 ml-5"]) } px-3 py-2 rounded-md bg-gray-100 flex flex-row items-center border border-primary--red` }>
                                    <SearchIcon size={ 22 } style={ Tailwind`text-primary--red opacity-70` }/>
                                    <TextInput
                                        scrollEnabled={ false }
                                        placeholder={ "Cari" }
                                        style={ Tailwind`p-0 text-sm text-primary--red flex-grow ml-3 tracking-wide font-rubik-regular` }
                                        placeholderTextColor={ "#F2414180" }
                                    />
                                </View>
                                <CogIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70 ml-5` }/> */}
                                <Image
                                    source={ { uri: "https://images.unsplash.com/photo-1593085512500-5d55148d6f0d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y2FydG9vbnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60" } }
                                    resizeMode={ "contain" }
                                    style={ Tailwind`w-11 h-11 rounded-full ml-5` }
                                />
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-6` }>
                            <View style={ Tailwind`flex flex-col` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Singkronisasi Data WeMart
                                </Text>
                                <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                    Lakukan singkronisasi untuk perbarui data WeMart
                                </Text>
                            </View>
                            <View style={ Tailwind`flex flex-row items-center justify-between mt-3` }>
                                <View style={ Tailwind`flex flex-col` }>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                        Terakhir Disingkronkan
                                    </Text>
                                    <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                        Belum Pernah
                                    </Text>
                                </View>
                                <View style={ Tailwind`w-40` }>
                                    <ButtonPrimary text={ "Singkronisasi" }/>
                                </View>
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-3` }>
                            <View style={ Tailwind`w-full py-5 rounded-lg bg-primary--red--20 flex flex-col items-center rounded-lg` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-primary--red` }>
                                    Umum
                                </Text>
                            </View>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-5` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Bahasa
                                </Text>
                                <View style={ Tailwind`flex flex-row items-center` }>
                                    <Text style={ Tailwind`font-rubik-regular text-xs text-primary--red` }>
                                        Indonesia
                                    </Text>
                                    <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                                </View>
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-3` }>
                            <View style={ Tailwind`w-full py-5 rounded-lg bg-primary--red--20 flex flex-col items-center rounded-lg` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-primary--red` }>
                                    Halaman Transaksi
                                </Text>
                            </View>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-5` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Tampilkan Kategori
                                </Text>
                                <View style={ Tailwind`flex flex-row items-center` }>
                                    <Text style={ Tailwind`font-rubik-regular text-xs text-primary--red` }>
                                        Compact
                                    </Text>
                                    <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                                </View>
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-3` }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Tampilkan Katalog
                                </Text>
                                <View style={ Tailwind`flex flex-row items-center` }>
                                    <Text style={ Tailwind`font-rubik-regular text-xs text-primary--red` }>
                                        List
                                    </Text>
                                    <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                                </View>
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between p-6 bg-white rounded-2xl mt-3` }>
                            <View style={ Tailwind`flex flex-col` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Tambah Multi Varian
                                </Text>
                                <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                    Kamu bisa menambahkan multi varian langsung kedalam keranjang
                                </Text>
                            </View>
                            <ToggleSwitch
                                isOn={ variant }
                                onColor={ "red" }
                                offColor={ "gray" }
                                size={ "medium" }
                                onToggle={ (isOn) => setVariant((value) => !value) }
                            />
                        </View>
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between p-6 bg-white rounded-2xl mt-3` }>
                            <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                Tipe Order
                            </Text>
                            <ToggleSwitch
                                isOn={ variant }
                                onColor={ "red" }
                                offColor={ "gray" }
                                size={ "medium" }
                                onToggle={ (isOn) => setVariant((value) => !value) }
                            />
                        </View>
                        <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-3` }>
                            <View style={ Tailwind`w-full py-5 rounded-lg bg-primary--red--20 flex flex-col items-center rounded-lg` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-primary--red` }>
                                    Halaman Pembayaran
                                </Text>
                            </View>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-5` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Tampilkan Pembayaran
                                </Text>
                                <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-3` }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Pajak
                                </Text>
                                <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-3` }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Kelola Diskon
                                </Text>
                                <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-3` }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Kelola Pembayaran Digital
                                </Text>
                                <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-3` }>
                            <View style={ Tailwind`w-full py-5 rounded-lg bg-primary--red--20 flex flex-col items-center rounded-lg` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-primary--red` }>
                                    Fitur Tambahan
                                </Text>
                            </View>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-5` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Otoritas Pegawai
                                </Text>
                                <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-3` }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Rekap Kas
                                </Text>
                                <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-3` }>
                            <View style={ Tailwind`w-full flex flex-row items-center` }>
                                <View style={ Tailwind`flex-grow py-5 rounded-lg bg-primary--red--20 flex flex-col items-center rounded-lg` }>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-primary--red` }>
                                        Perangkat Tambahan
                                    </Text>
                                </View>
                                <View style={ Tailwind`w-40 ml-3` }>
                                    <ButtonPrimary text={ "Beli" }/>
                                </View>
                            </View>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-5` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Printer
                                </Text>
                                <View style={ Tailwind`flex flex-row items-center` }>
                                    <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                        Belum Terhubung
                                    </Text>
                                    <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                                </View>
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-3` }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Barcode Scanner
                                </Text>
                                <View style={ Tailwind`flex flex-row items-center` }>
                                    <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                        Belum Terhubung
                                    </Text>
                                    <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                                </View>
                            </View>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-3` }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                    Atur Struk
                                </Text>
                                <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                            </View>
                        </View>
                        <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => setIsShow((value) => !value) } style={ Tailwind`w-full mt-3` }>
                            <ButtonSecondary text={ "Keluar" }/>
                        </TouchableHighlight>
                        <View style={ Tailwind`h-6` }/>
                    </ScrollView>
                </View>
                {
                    isShow ? 
                        <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: height }] }>
                            <View style={ Tailwind`w-96 rounded-xl bg-white p-5 flex flex-col items-center` }>
                                <View style={ Tailwind`w-full flex flex-col items-center` }>
                                    <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                        Keluar Akun
                                    </Text>
                                    <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80 text-center` }>
                                        Anda yakin ingin keluar?
                                    </Text>
                                </View>
                                <View style={ Tailwind`w-full my-5 h-px bg-gray-200` }/>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-end` }>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`flex-1` } onPress={ () => handleLogout() }>
                                        <ButtonSecondary text={ "Keluar" }/>
                                    </TouchableHighlight>
                                    <View style={ Tailwind`w-3` }/>
                                    <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => setIsShow((value) => !value) } style={ Tailwind`flex-1` }>
                                        <ButtonPrimary text={ "Batal" }/>
                                    </TouchableHighlight>
                                </View>
                            </View>
                        </View> : null
                }
            </SafeAreaView>
        </Fragment>
    )
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeDrawerStatus : (value) => dispatch({type: 'CHANGE_DRAWERSTATUS', newValue: value}),
        changeUser: (value) => dispatch({ type: 'CHANGE_USER', newValue: value }),
        changeCart: (value) => dispatch({ type: `CHANGE_CART`, newValue: value }),
        changeProducts: (value) => dispatch({ type: `CHANGE_PRODUCTS`, newValue: value }),
        changeCategories: (value) => dispatch({ type: `CHANGE_CATEGORIES`, newValue: value }),
        changeTransactions: (value) => dispatch({ type: `CHANGE_TRANSACTIONS`, newValue: value })
    }
}

export default connect(null, mapDispatchToProps)(Setting)