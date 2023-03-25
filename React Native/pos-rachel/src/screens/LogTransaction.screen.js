import React, { Fragment, useState, useEffect, createContext } from "react"
import { Text, View, Dimensions, ScrollView, TouchableHighlight, Image, TextInput, ActivityIndicator, SafeAreaView } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { MenuIcon, SearchIcon } from "react-native-heroicons/solid"
import { CogIcon, NewspaperIcon, ChevronRightIcon } from "react-native-heroicons/outline"
import { connect } from "react-redux"
import Drawer from "../components/organisms/Drawer.organism"
import ItemTagBar from "../components/molecules/ItemTagBar.molecule"
import OrderFetching from "../libs/fetching/OrderFetching.lib"
import DatePicker from "react-native-date-picker"

const TagContext = createContext()
const { Provider } = TagContext

const LogTransaction = ({ changeDrawerStatus, navigation, user }) => {
    const [height, setHeight] = useState(0)
    const [isLoading, setIsLoading] = useState(false)
    const [tag, setTag] = useState("Tunai")
    const [widthScreen, setWidthScreen] = useState(0)
    const [transactions, setTransactions] = useState([])
    const [date, setDate] = useState({
        from_date: new Date(),
        to_date: new Date()
    })

    const handleResponsive = (actions) => {
        if (widthScreen > 0 && widthScreen <= 1000) {
            return actions[0]
        } else if(widthScreen > 1000) {
            return actions[1]
        } else {
            return actions[0]
        }
    }

    const getDataTunai = async () => {
        setIsLoading(true)

        const result = await OrderFetching().getOrders(date)

        setTransactions([...result])

        setIsLoading(false)
    }

    const getDataKasbon = () => {
        setTransactions([])
    }

    const getData = () => {
        (tag === "Tunai") ? getDataTunai() : getDataKasbon()
    }

    useEffect(() => {
        getData()
    }, [tag])

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

    useEffect(() => {
        if(tag === "Tunai") {
            getDataTunai()
        }
    }, [date])

    const renderTime = (data) => {
        const timeSplit = data.split(":")
        let result = ""

        if(parseInt(timeSplit[0]) < 10) {
            result += `0${ timeSplit[0] }`
        } else {
            result += `${ timeSplit[0] }`
        }

        if(parseInt(timeSplit[1]) < 10) {
            result += `:0${ timeSplit[1] }`
        } else {
            result += `:${ timeSplit[1] }`
        }

        return result
    }

    return (
        <Fragment>
            <SafeAreaView>
                <Provider value={ { tag, setTag } }>
                    <Drawer/>
                    <View style={ [Tailwind`w-full flex flex-col bg-primary--red--20 px-6`, { height }] }>
                        <ScrollView showsVerticalScrollIndicator={ false }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-6` }>
                                <View style={ Tailwind`flex flex-row items-center` }>
                                    <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-md` } onPress={ () => changeDrawerStatus(true) }>
                                        <MenuIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                                    </TouchableHighlight>
                                    <Text style={ Tailwind`font-rubik-semibold text-primary--red ml-4 text-base` }>
                                        Riwayat Transaksi
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
                                        source={ { uri: user.avatar } }
                                        resizeMode={ "contain" }
                                        style={ Tailwind`w-11 h-11 rounded-full ml-5` }
                                    />
                                </View>
                            </View>
                            <View style={ Tailwind`w-full flex flex-col p-6 bg-white rounded-2xl mt-6` }>
                                <View style={ Tailwind`flex flex-row items-center w-full` }>
                                    <ItemTagBar text={ "Tunai" } context={ TagContext }/>
                                    <View style={ Tailwind`w-5` }/>
                                    <ItemTagBar text={ "Kasbon" } context={ TagContext }/>
                                </View>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-6` }>
                                    <DatePicker
                                        mode="date"
                                        date={ date.from_date }
                                        style={ Tailwind`flex-1` }
                                        onDateChange={ (data) => setDate({ ...date, from_date: data }) }
                                    />
                                    <DatePicker
                                        mode="date"
                                        date={ date.to_date }
                                        style={ Tailwind`flex-1` }
                                        onDateChange={ (data) => setDate({ ...date, to_date: data }) }
                                    />
                                </View>
                                {
                                    transactions.length ? 
                                        React.Children.toArray(transactions.map((item) => {
                                            return (
                                                <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => navigation.push("DetailTransaction", { data: item }) }>
                                                    <View style={ Tailwind`w-full flex flex-row items-center justify-between py-6 border-b border-gray-200` }>
                                                        <View style={ Tailwind`flex flex-row items-center` }>
                                                            <NewspaperIcon size={ 24 } style={ Tailwind`text-accent--black opacity-70` }/>
                                                            <View style={ Tailwind`flex flex-col ml-5` }>
                                                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                                                    #{ item.order.id }
                                                                </Text>
                                                                <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                                                    { item.order.payment_method }
                                                                </Text>
                                                            </View>
                                                        </View>
                                                        <View style={ Tailwind`flex flex-row items-center` }>
                                                            <View style={ Tailwind`flex flex-col mr-3 items-end` }>
                                                                <Text style={ Tailwind`font-rubik-medium text-sm text-accent--black` }>
                                                                    Rp{ item.order.order_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }
                                                                </Text>
                                                                <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black opacity-80` }>
                                                                    { item.order.created_at }
                                                                </Text>
                                                            </View>
                                                            <ChevronRightIcon size={ 18 } style={ Tailwind`text-accent--black opacity-70` }/>
                                                        </View>
                                                    </View>
                                                </TouchableHighlight>
                                            )
                                        })) :
                                        <View style={ Tailwind`flex flex-col items-center mt-20 mb-30` }>
                                            <Image
                                                source={ require("../assets/ilustrations/box.png") }
                                                resizeMode={ "contain" }
                                                style={ Tailwind`w-50 h-50` }
                                            />
                                            <Text style={ Tailwind`font-rubik-medium text-accent--black text-sm` }>
                                                Tidak ada transaksi
                                            </Text>
                                            <Text style={ Tailwind`font-rubik-regular text-accent--black text-xs mt-1 tracking-wide leading-relaxed text-center opacity-80` }>
                                                Silahkan lakukan transaksi pada halaman kasir
                                            </Text>
                                        </View>
                                }
                            </View>
                            <View style={ Tailwind`h-12` }/>
                        </ScrollView>
                    </View>
                    {
                        isLoading ? 
                            <View style={ [Tailwind`w-full absolute bg-accent--black--60 flex flex-col items-center justify-center`, { height: Dimensions.get("screen").height }] }>
                                <ActivityIndicator color={ "#FFFFFF" } size={ "large" }/>
                            </View> : null
                    }
                </Provider>
            </SafeAreaView>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        user : state.user
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeDrawerStatus : (value) => dispatch({type: 'CHANGE_DRAWERSTATUS', newValue: value}),
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(LogTransaction)